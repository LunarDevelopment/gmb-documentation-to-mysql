<?php
/**
 * Copyright (c) 2019.
 *
 */

/**
 * Created by Lewis Dimmick.
 * File: FieldTranslator.php
 * User: Lewis
 * Date: 13/02/2019
 * Time: 11:19
 */

namespace Src\Parser\Translator;

use Src\Parser\Lexer\PseudoJsonLexer;
use Src\MySQL\Model\Field;
use Src\Parser\Extractor\TokenResult;

/**
 * Class FieldTranslator
 * @package Src\Parser\Translator
 */
class FieldTranslator
{

    /**
     *
     */
    const STRING = "VARCHAR(255)";
    const ARRAY_OF_STRING = "TEXT";
    const ARRAY_OF_INT = "TEXT";
    const BOOLEAN = "TINYINT(1) UNSIGNED";
    const INT = "BIGINT(32)";
    const ENUM = "VARCHAR(255)";

    private $field;
    private $tokenResult;

    /**
     * FieldTranslator constructor.
     * @param TokenResult $tokenResult
     */
    public function __construct(TokenResult $tokenResult)
    {
        $this->field = new Field();
        $this->tokenResult = $tokenResult;
        $this->translate();
    }

    /**
     * @return Field
     */
    public function getField()
    {
        return $this->field;
    }

    private function translate()
    {
//        echo $this->tokenResult->getValue() . ' IS ';
        preg_match("/(?:(?:\"(?:\\\\\"|[^\"])+\")|(?:'(?:\\\'|[^'])+'))/is",$this->tokenResult->getValue(),$match);
        if(!isset($match[0]))
            throw new \Exception('FieldTranslator->tokenResult must have a key between quotes.');
        $match[0] = str_replace('"', '', $match[0]);
        $this->field->setName($match[0]);

        switch ($this->tokenResult->getType()) {
            case PseudoJsonLexer::STRING:
                $this->field->setType(self::STRING);
                break;
            case PseudoJsonLexer::ARRAY_OF_STRING:
                $this->field->setType(self::ARRAY_OF_STRING);
                break;
            case PseudoJsonLexer::ARRAY_OF_INT:
                $this->field->setType(self::ARRAY_OF_INT);
                break;
            case PseudoJsonLexer::INT:
                $this->field->setType(self::INT);
                break;
            case PseudoJsonLexer::BOOLEAN:
                $this->field->setType(self::BOOLEAN);
                break;
            case PseudoJsonLexer::ENUM:
                $this->field->setType(self::ENUM);
                break;
        }
    }
}