<?php
/**
 * Copyright (c) 2019.
 *
 */

/**
 * Created by Lewis Dimmick.
 * File: TokenResult.php
 * User: Lewis
 * Date: 13/02/2019
 * Time: 09:58
 */

namespace Src\Parser\Extractor;


/**
 * Class TokenResult
 * @package Src\Parser\Extractor
 */
class TokenResult
{

    public $value;
    public $type;
    public $position;

    /**
     * TokenResult constructor.
     * @param array $token
     */
    public function __construct( array $token, bool $format = true )
    {
        $this->value = $token['value'];
        $this->type = $token['type'];
        $this->position = $token['position'];
        $this->format = $format;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->format ? preg_replace('/\s+/S', " ", $this->value)  : $this->value;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

}