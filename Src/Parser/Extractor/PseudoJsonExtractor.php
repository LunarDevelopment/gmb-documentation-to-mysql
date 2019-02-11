<?php
/**
 * Copyright (c) 2019.
 *
 */

/**
 * Created by Lewis Dimmick.
 * Deliver Marketing
 * File: PsudoJsonExtracter.php
 * User: Lewis
 * Date: 11/02/2019
 * Time: 15:22
 */

namespace Src\Parser\Extractor;

use Src\Parser\Lexer\PseudoJsonLexer;

class PseudoJsonExtractor
{
    private $lexer;

    public function __construct(PseudoJsonLexer $lexer)
    {
        $this->lexer = $lexer;
    }

    public function getUpperCaseCharacters($string)
    {
        $this->lexer->setInput($string);
        $this->lexer->moveNext();

        $upperCaseChars = array();
        while (true) {
            if (!$this->lexer->lookahead) {
                break;
            }

            $this->lexer->moveNext();

            if ($this->lexer->token['type'] === PseudoJsonLexer::T_UPPER) {
                $upperCaseChars[] = $this->lexer->token['value'];
            }
        }

        return $upperCaseChars;
    }

}