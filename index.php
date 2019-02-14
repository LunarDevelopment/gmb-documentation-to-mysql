<?php
/**
 * Copyright (c) 2019.
 *
 */

/**
 * Created by Lewis Dimmick.
 * Deliver Marketing
 * File: index.php
 * User: Lewis
 * Date: 11/02/2019
 * Time: 15:26
 */
require 'vendor/autoload.php';

use Src\Parser\Extractor\PseudoJsonExtractor;
use Src\Parser\Lexer\PseudoJsonLexer;
use Src\Parser\Translator\FieldTranslator;
use Src\Parser\Translator\RelationshipTranslator;

$tableName = 'Location' ;
$jsonExample = '
{
   "customProp": number,
   "name": string,
   "openDay": enum(DayOfWeek),
   "additionalPhones": [
    number
   ],
   "additionalStrings": [
    string
   ],
   "address": {
    object(PostalAddress)
   },
   "additionalCategories": [
    {
      object(Category)
    }
   ]
 }
';

$pseudoJsonExtractor = new PseudoJsonExtractor(new PseudoJsonLexer());
$pseudoJsonExtractor->setString($jsonExample);
$pseudoJson = $pseudoJsonExtractor->getAllFields();
//$pseudoJson = $pseudoJsonExtractor->getFieldsByType(PseudoJsonLexer::ENUM);

$fields = array();
$relationships = array();

foreach ($pseudoJson as $item) {
    if($item->getType() == PseudoJsonLexer::ONE_TO_MANY || $item->getType() == PseudoJsonLexer::ONE_TO_ONE){
        $newRelationship = new RelationshipTranslator($item);
        $newRelationship= $newRelationship->getRelationship();
        $newRelationship->setDestination($tableName);
        $relationships[$newRelationship->getSource()] = $newRelationship;
    }  else {
        $newField = new FieldTranslator($item);
        $newField= $newField->getField();
        $fields[] = $newField;
    }
}

echo "+++++++++++++++++++++++++++++++++++++++" . PHP_EOL;
echo "+++++++++++++  Relationships  +++++++++" . PHP_EOL;
echo "+++++++++++++++++++++++++++++++++++++++" . PHP_EOL;
print_r($relationships);

echo "+++++++++++++++++++++++++++++++++++++++" . PHP_EOL;
echo "++++++++++++++++ Fields  ++++++++++++++" . PHP_EOL;
echo "+++++++++++++++++++++++++++++++++++++++" . PHP_EOL;

print_r($fields);
die;

$query = "CREATE TABLE $tableName ( ";
for($i=0; $i<count($fields) ;$i=$i+1)
{
    echo $i . " " . count($fields) . PHP_EOL;
    $query .= "`" . $fields[$i]->getName()  . "`" . " " .  $fields[$i]->getType()  . " DEFAULT " .  $fields[$i]->getDefault() . " " ;
    if($i < (count($fields) -1 ) )
        $query .=  " , "  ;
}
$query .= " ); ";

echo $query;//output and check your query


