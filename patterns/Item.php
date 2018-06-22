<?php
/**
 * Created by PhpStorm.
 * User: sovkutsan
 * Date: 6/22/18
 * Time: 10:26 AM
 */

class Item
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var \DateTime
     */
    protected $dateCreation;

    /**
     * @var integer
     */
    protected $secretNumber;

    /**
     * @var string
     */
    protected $binary;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param DateTime $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return int
     */
    public function getSecretNumber()
    {
        return $this->secretNumber;
    }

    /**
     * @param int $secretNumber
     */
    public function setSecretNumber($secretNumber)
    {
        $this->secretNumber = $secretNumber;
    }

    /**
     * @return string
     */
    public function getBinary()
    {
        return $this->binary;
    }

    /**
     * @param string $binary
     */
    public function setBinary($binary)
    {
        $this->binary = $binary;
    }
}