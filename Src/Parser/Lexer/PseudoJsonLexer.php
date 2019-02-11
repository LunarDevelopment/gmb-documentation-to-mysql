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
    const T_UPPER =  1;
    const T_LOWER =  2;
    const T_NUMBER = 3;

    protected function getCatchablePatterns()
    {
        return array(
            '[a-bA-Z0-9]',
        );
    }

    protected function getNonCatchablePatterns()
    {
        return array();
    }

    protected function getType(&$value)
    {
        if (is_numeric($value)) {
            return self::T_NUMBER;
        }

        if (strtoupper($value) === $value) {
            return self::T_UPPER;
        }

        if (strtolower($value) === $value) {
            return self::T_LOWER;
        }
    }
}