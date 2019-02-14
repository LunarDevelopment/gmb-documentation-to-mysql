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
    private $string;

    public function __construct(PseudoJsonLexer $lexer)
    {
        $this->lexer = $lexer;
    }

    /**
     * @return mixed
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * @param mixed $string
     */
    public function setString($string)
    {
        $this->string = $string;
        $this->lexer->setInput($this->string);
    }

    public function getAllFields()
    {
        $this->lexer->moveNext();

        $fields = array();
        while (true) {
            if (!$this->lexer->lookahead) {
                break;
            }
            $this->lexer->moveNext();
            if(!$this->lexer->token['type'])
                continue;
            $fields[] = new TokenResult($this->lexer->token) ;
        }

        return $fields;
    }

    public function getFieldsByType($type)
    {
        $this->lexer->moveNext();

        $fields = array();
        while (true) {
            if (!$this->lexer->lookahead) {
                break;
            }
            $this->lexer->moveNext();
            if ($this->lexer->token['type'] === $type) {
                $fields[] = new TokenResult($this->lexer->token) ;
            }
        }

        return $fields;
    }

}