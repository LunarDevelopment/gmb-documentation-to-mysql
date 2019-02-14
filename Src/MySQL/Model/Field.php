<?php
/**
 * Copyright (c) 2019.
 *
 */

/**
 * Created by Lewis Dimmick.
 * File: Field.php
 * User: Lewis
 * Date: 13/02/2019
 * Time: 10:42
 */

namespace Src\MySQL\Model;

class Field
{
    private $type;
    private $name;
    private $default;

    /**
     * Field constructor.
     * @param $default
     */
    public function __construct($default = 'NULL')
    {
        $this->default = $default;
    }


    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return trim($this->name);
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return is_null($this->default ) ? "NULL" : $this->default;
    }

    /**
     * @param mixed $default
     */
    public function setDefault($default)
    {
        $this->default = $default;
    }


}