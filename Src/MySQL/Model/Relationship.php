<?php
/**
 * Copyright (c) 2019.
 *
 */

/**
 * Created by Lewis Dimmick.
 * File: Relationship.php
 * User: Lewis
 * Date: 13/02/2019
 * Time: 13:17
 */

namespace Src\MySQL\Model;


/**
 * Class Relationship
 * @package Src\MySQL\Model
 */
class Relationship
{
    /**
     * @var
     */
    private $type;
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $source;
    /**
     * @var
     */
    private $destination;
    /**
     * @var
     */
    private $foreignKey;

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
        return $this->name;
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
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
        $this->setForeignKey();
    }

    /**
     * @return mixed
     */
    public function getForeignKey()
    {
        return $this->foreignKey;
    }

    /**
     * @param mixed $foreignKey
     */
    public function setForeignKey()
    {
        $this->foreignKey = $this->destination . "Id";
    }


}