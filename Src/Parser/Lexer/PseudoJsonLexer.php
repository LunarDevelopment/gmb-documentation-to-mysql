<?php
/**
 * Copyright (c) 2019.
 *
 */

/**
 * Created by Lewis Dimmick.
 * Deliver Marketing
 * File: PsudoJsonLexer.php
 * User: Lewis
 * Date: 11/02/2019
 * Time: 15:19
 */

namespace Src\Parser\Lexer;

use Doctrine\Common\Lexer\AbstractLexer;

class PseudoJsonLexer extends AbstractLexer
{
    const STRING =  "STRING";
    const ARRAY_OF_STRING =  "ARRAY_OF_STRING";
    const INT =  "INT";
    const ENUM =  "ENUM";
    const BOOLEAN =  "BOOLEAN";
    const ARRAY_OF_INT =  "ARRAY_OF_INT";
    const ONE_TO_ONE = "ONE_TO_ONE";
    const ONE_TO_MANY = "ONE_TO_MANY";

    protected function getCatchablePatterns()
    {
        return array(
            '(?:\"|\')([^"]*)(?:\"|\')(?=:)(?:\:\s*)(?:\")?(true|false|[-0-9]+[\.]*[\d]*(?=,)|[0-9a-zA-Z\(\)\@\:\,\/\!\+\-\.\$\ \\\\\']*)(?!\s*{|\s*\[)(?:[^\s*{]|[^\s*\[])', // standard json key value pair
            '(?:\"|\')([^"]*)(?:\"|\')(?=:)(?:\:\s*)(?:\")?(?:\[\n\s*)(?=string)(string)', // Array of strings
            '(?:\"|\')([^"]*)(?:\"|\')(?=:)(?:\:\s*)?(?:\[\n\s*)(?=number)(number)', // Array of integers
            // TODO: need to adjust these to handle JSON on one line, maybe just change the \n checks to be optional
            '(?:\"|\')([^"]*)(?:\"|\')(?=:)(?:\:\s*)(?:\")?(?:\[\n\s*\{\n\s*)(?=object)(object\([a-zA-Z]*\))', // one to many relationships
            '(?:\"|\')([^"]*)(?:\"|\')(?=:)(?:\:\s*)(?:\")?(?:\{\n\s*)(?=object)(object\([a-zA-Z]*\))' // one to one relationships

        );
    }

    protected function getNonCatchablePatterns()
    {
        return array();
    }

    protected function getType(&$value)
    {
        $tempValue = trim(preg_replace('/[^\da-z:\(\[{]/i', '', $value));

        if (strpos($tempValue, ":string") !== FALSE) {
            return self::STRING;
        }
        if (strpos($tempValue, ":[string") !== FALSE) {
            return self::ARRAY_OF_STRING;
        }
        if (strpos($tempValue, ":[number") !== FALSE) {
            return self::ARRAY_OF_INT;
        }
         if (strpos($tempValue, ":number") !== FALSE) {
            return self::INT;
        }
         if (strpos($tempValue, ":boolean") !== FALSE) {
            return self::BOOLEAN;
        }
         if (strpos($tempValue, ":enum(") !== FALSE) {
            return self::ENUM;
        }
         if (strpos($tempValue, ":{") !== FALSE) {
            return self::ONE_TO_ONE;
        }
        if (strpos($tempValue, ":[{") !== FALSE) {
            return self::ONE_TO_MANY;
        }
        else
            return false;
    }


//preg_match_all(sprintf('/(%s)|%s/%s','/(?:\"|\')([^"]*)(?:\"|\')(?=:)(?:\:\s*)(?:\")?(?:\[\n\s*\{\n\s*)(?=object)(object\([a-zA-Z]*\))?/m', null, null ), $input, $matches, PREG_SET_ORDER, 0);


}