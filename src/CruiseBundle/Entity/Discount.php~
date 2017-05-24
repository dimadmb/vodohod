<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Discount
 *
 * @ORM\Table(name="discount")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\DiscountRepository")
 */
class Discount
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="validation", type="boolean")
     */
    private $validation;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="decimal", precision=10, scale=2)
     */
    private $value;

    /**
     * @var bool
     *
     * @ORM\Column(name="valueFromCruise", type="boolean")
     */
    private $valueFromCruise;

    /**
     * @var bool
     *
     * @ORM\Column(name="isTariff", type="boolean")
     */
    private $isTariff;

    /**
     * @var bool
     *
     * @ORM\Column(name="isTariffChildren", type="boolean")
     */
    private $isTariffChildren;

    /**
     * @var bool
     *
     * @ORM\Column(name="isTariffPrivilege", type="boolean")
     */
    private $isTariffPrivilege;

    /**
     * @var bool
     *
     * @ORM\Column(name="isTariffWithoutPlace", type="boolean")
     */
    private $isTariffWithoutPlace;

    /**
     * @var bool
     *
     * @ORM\Column(name="withoutFatername", type="boolean")
     */
    private $withoutFatername;

    /**
     * @var string
     *
     * @ORM\Column(name="tariffPrice", type="decimal", precision=10, scale=2)
     */
    private $tariffPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="tariffFactor", type="integer")
     */
    private $tariffFactor;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="hideInTables", type="boolean")
     */
    private $hideInTables;

    /**
     * @var bool
     *
     * @ORM\Column(name="plus", type="boolean")
     */
    private $plus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="payingDateStart", type="date")
     */
    private $payingDateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="payingDateStop", type="date")
     */
    private $payingDateStop;

    /**
     * @var float
     *
     * @ORM\Column(name="priority", type="float")
     */
    private $priority;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var bool
     *
     * @ORM\Column(name="ToAllCruises", type="boolean")
     */
    private $toAllCruises;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cruiseDateStart", type="date")
     */
    private $cruiseDateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cruiseDateStop", type="date")
     */
    private $cruiseDateStop;

    /**
     * @var bool
     *
     * @ORM\Column(name="forAgency", type="boolean")
     */
    private $forAgency;

    /**
     * @var int
     *
     * @ORM\Column(name="placesLimit", type="integer")
     */
    private $placesLimit;

    /**
     * @var int
     *
     * @ORM\Column(name="calculationType", type="integer")
     */
    private $calculationType;

    /**
     * @var bool
     *
     * @ORM\Column(name="isInShop", type="boolean")
     */
    private $isInShop;

    /**
     * @var bool
     *
     * @ORM\Column(name="forAgenciesFromList", type="boolean")
     */
    private $forAgenciesFromList;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Discount
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set validation
     *
     * @param boolean $validation
     *
     * @return Discount
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;

        return $this;
    }

    /**
     * Get validation
     *
     * @return bool
     */
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Discount
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Discount
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set valueFromCruise
     *
     * @param boolean $valueFromCruise
     *
     * @return Discount
     */
    public function setValueFromCruise($valueFromCruise)
    {
        $this->valueFromCruise = $valueFromCruise;

        return $this;
    }

    /**
     * Get valueFromCruise
     *
     * @return bool
     */
    public function getValueFromCruise()
    {
        return $this->valueFromCruise;
    }

    /**
     * Set isTariff
     *
     * @param boolean $isTariff
     *
     * @return Discount
     */
    public function setIsTariff($isTariff)
    {
        $this->isTariff = $isTariff;

        return $this;
    }

    /**
     * Get isTariff
     *
     * @return bool
     */
    public function getIsTariff()
    {
        return $this->isTariff;
    }

    /**
     * Set isTariffChildren
     *
     * @param boolean $isTariffChildren
     *
     * @return Discount
     */
    public function setIsTariffChildren($isTariffChildren)
    {
        $this->isTariffChildren = $isTariffChildren;

        return $this;
    }

    /**
     * Get isTariffChildren
     *
     * @return bool
     */
    public function getIsTariffChildren()
    {
        return $this->isTariffChildren;
    }

    /**
     * Set isTariffPrivilege
     *
     * @param boolean $isTariffPrivilege
     *
     * @return Discount
     */
    public function setIsTariffPrivilege($isTariffPrivilege)
    {
        $this->isTariffPrivilege = $isTariffPrivilege;

        return $this;
    }

    /**
     * Get isTariffPrivilege
     *
     * @return bool
     */
    public function getIsTariffPrivilege()
    {
        return $this->isTariffPrivilege;
    }

    /**
     * Set isTariffWithoutPlace
     *
     * @param boolean $isTariffWithoutPlace
     *
     * @return Discount
     */
    public function setIsTariffWithoutPlace($isTariffWithoutPlace)
    {
        $this->isTariffWithoutPlace = $isTariffWithoutPlace;

        return $this;
    }

    /**
     * Get isTariffWithoutPlace
     *
     * @return bool
     */
    public function getIsTariffWithoutPlace()
    {
        return $this->isTariffWithoutPlace;
    }

    /**
     * Set withoutFatername
     *
     * @param boolean $withoutFatername
     *
     * @return Discount
     */
    public function setWithoutFatername($withoutFatername)
    {
        $this->withoutFatername = $withoutFatername;

        return $this;
    }

    /**
     * Get withoutFatername
     *
     * @return bool
     */
    public function getWithoutFatername()
    {
        return $this->withoutFatername;
    }

    /**
     * Set tariffPrice
     *
     * @param string $tariffPrice
     *
     * @return Discount
     */
    public function setTariffPrice($tariffPrice)
    {
        $this->tariffPrice = $tariffPrice;

        return $this;
    }

    /**
     * Get tariffPrice
     *
     * @return string
     */
    public function getTariffPrice()
    {
        return $this->tariffPrice;
    }

    /**
     * Set tariffFactor
     *
     * @param integer $tariffFactor
     *
     * @return Discount
     */
    public function setTariffFactor($tariffFactor)
    {
        $this->tariffFactor = $tariffFactor;

        return $this;
    }

    /**
     * Get tariffFactor
     *
     * @return int
     */
    public function getTariffFactor()
    {
        return $this->tariffFactor;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Discount
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set hideInTables
     *
     * @param boolean $hideInTables
     *
     * @return Discount
     */
    public function setHideInTables($hideInTables)
    {
        $this->hideInTables = $hideInTables;

        return $this;
    }

    /**
     * Get hideInTables
     *
     * @return bool
     */
    public function getHideInTables()
    {
        return $this->hideInTables;
    }

    /**
     * Set plus
     *
     * @param boolean $plus
     *
     * @return Discount
     */
    public function setPlus($plus)
    {
        $this->plus = $plus;

        return $this;
    }

    /**
     * Get plus
     *
     * @return bool
     */
    public function getPlus()
    {
        return $this->plus;
    }

    /**
     * Set payingDateStart
     *
     * @param \DateTime $payingDateStart
     *
     * @return Discount
     */
    public function setPayingDateStart($payingDateStart)
    {
        $this->payingDateStart = $payingDateStart;

        return $this;
    }

    /**
     * Get payingDateStart
     *
     * @return \DateTime
     */
    public function getPayingDateStart()
    {
        return $this->payingDateStart;
    }

    /**
     * Set payingDateStop
     *
     * @param \DateTime $payingDateStop
     *
     * @return Discount
     */
    public function setPayingDateStop($payingDateStop)
    {
        $this->payingDateStop = $payingDateStop;

        return $this;
    }

    /**
     * Get payingDateStop
     *
     * @return \DateTime
     */
    public function getPayingDateStop()
    {
        return $this->payingDateStop;
    }

    /**
     * Set priority
     *
     * @param float $priority
     *
     * @return Discount
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return float
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Discount
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set toAllCruises
     *
     * @param boolean $toAllCruises
     *
     * @return Discount
     */
    public function setToAllCruises($toAllCruises)
    {
        $this->toAllCruises = $toAllCruises;

        return $this;
    }

    /**
     * Get toAllCruises
     *
     * @return bool
     */
    public function getToAllCruises()
    {
        return $this->toAllCruises;
    }

    /**
     * Set cruiseDateStart
     *
     * @param \DateTime $cruiseDateStart
     *
     * @return Discount
     */
    public function setCruiseDateStart($cruiseDateStart)
    {
        $this->cruiseDateStart = $cruiseDateStart;

        return $this;
    }

    /**
     * Get cruiseDateStart
     *
     * @return \DateTime
     */
    public function getCruiseDateStart()
    {
        return $this->cruiseDateStart;
    }

    /**
     * Set cruiseDateStop
     *
     * @param \DateTime $cruiseDateStop
     *
     * @return Discount
     */
    public function setCruiseDateStop($cruiseDateStop)
    {
        $this->cruiseDateStop = $cruiseDateStop;

        return $this;
    }

    /**
     * Get cruiseDateStop
     *
     * @return \DateTime
     */
    public function getCruiseDateStop()
    {
        return $this->cruiseDateStop;
    }

    /**
     * Set forAgency
     *
     * @param boolean $forAgency
     *
     * @return Discount
     */
    public function setForAgency($forAgency)
    {
        $this->forAgency = $forAgency;

        return $this;
    }

    /**
     * Get forAgency
     *
     * @return bool
     */
    public function getForAgency()
    {
        return $this->forAgency;
    }

    /**
     * Set placesLimit
     *
     * @param integer $placesLimit
     *
     * @return Discount
     */
    public function setPlacesLimit($placesLimit)
    {
        $this->placesLimit = $placesLimit;

        return $this;
    }

    /**
     * Get placesLimit
     *
     * @return int
     */
    public function getPlacesLimit()
    {
        return $this->placesLimit;
    }

    /**
     * Set calculationType
     *
     * @param integer $calculationType
     *
     * @return Discount
     */
    public function setCalculationType($calculationType)
    {
        $this->calculationType = $calculationType;

        return $this;
    }

    /**
     * Get calculationType
     *
     * @return int
     */
    public function getCalculationType()
    {
        return $this->calculationType;
    }

    /**
     * Set isInShop
     *
     * @param boolean $isInShop
     *
     * @return Discount
     */
    public function setIsInShop($isInShop)
    {
        $this->isInShop = $isInShop;

        return $this;
    }

    /**
     * Get isInShop
     *
     * @return bool
     */
    public function getIsInShop()
    {
        return $this->isInShop;
    }

    /**
     * Set forAgenciesFromList
     *
     * @param boolean $forAgenciesFromList
     *
     * @return Discount
     */
    public function setForAgenciesFromList($forAgenciesFromList)
    {
        $this->forAgenciesFromList = $forAgenciesFromList;

        return $this;
    }

    /**
     * Get forAgenciesFromList
     *
     * @return bool
     */
    public function getForAgenciesFromList()
    {
        return $this->forAgenciesFromList;
    }
}
