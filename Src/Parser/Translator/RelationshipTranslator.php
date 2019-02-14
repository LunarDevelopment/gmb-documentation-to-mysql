<?php
/**
 * Copyright (c) 2019.
 *
 */

/**
 * Created by Lewis Dimmick.
 * File: RelationshipTranslator.php
 * User: Lewis
 * Date: 13/02/2019
 * Time: 11:19
 */

namespace Src\Parser\Translator;

use Src\Parser\Lexer\PseudoJsonLexer;
use Src\MySQL\Model\Relationship;
use Src\Parser\Extractor\TokenResult;

/**
 * Class RelationshipTranslator
 * @package Src\Parser\Translator
 */
class RelationshipTranslator
{

    /**
     *
     */
    const ONE_TO_ONE = "ONE_TO_ONE";  //            Not needed as they're inbound relationship relationships
    const ONE_TO_MANY = "ONE_TO_MANY";  //            Not needed as they're inbound relationship relationships

    private $relationship;
    private $tokenResult;

    /**
     * RelationshipTranslator constructor.
     * @param TokenResult $tokenResult
     */
    public function __construct(TokenResult $tokenResult)
    {
        $this->relationship = new Relationship();
        $this->tokenResult = $tokenResult;
        $this->translate();
    }

    /**
     * @return Relationship
     */
    public function getRelationship()
    {
        return $this->relationship;
    }

    private function translate()
    {
//        echo $this->tokenResult->getValue() . ' IS ';
        preg_match("/(?:(?:\"(?:\\\\\"|[^\"])+\")|(?:'(?:\\\'|[^'])+'))/is",$this->tokenResult->getValue(),$key);
        if(!isset($key[0]))
            throw new \Exception('RelationshipTranslator->tokenResult must have a key between quotes.');
        preg_match( '/\((.*?)\)/is', $this->tokenResult->getValue(),$source);
        if(!isset($source[0]))
            throw new \Exception('RelationshipTranslator->tokenResult must have a key between quotes.');
        $source[0] = preg_replace('/\(|\)/','',  $source[0]);

        $this->relationship->setName($key[0]);
        $this->relationship->setSource($source[0]);

        switch ($this->tokenResult->getType()) {
            case PseudoJsonLexer::ONE_TO_ONE:
                $this->relationship->setType(self::ONE_TO_ONE);
                break;
            case PseudoJsonLexer::ONE_TO_MANY:
                $this->relationship->setType(self::ONE_TO_MANY);
                break;
        }
    }
}