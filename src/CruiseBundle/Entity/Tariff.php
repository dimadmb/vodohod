<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tariff
 *
 * @ORM\Table(name="tariff")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\TariffRepository")
 */
class Tariff
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
     * @ORM\Column(name="validation", type="boolean", nullable=true)
     */
    private $validation;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $value;

    /**
     * @var bool
     *
     * @ORM\Column(name="valueFromCruise", type="boolean", nullable=true)
     */
    private $valueFromCruise;


    /**
     * @var bool
     *
     * @ORM\Column(name="isTariffChildren", type="boolean", nullable=true)
     */
    private $isTariffChildren;

    /**
     * @var bool
     *
     * @ORM\Column(name="isTariffPrivilege", type="boolean", nullable=true)
     */
    private $isTariffPrivilege;

    /**
     * @var bool
     *
     * @ORM\Column(name="isTariffWithoutPlace", type="boolean", nullable=true)
     */
    private $isTariffWithoutPlace;

    /**
     * @var bool
     *
     * @ORM\Column(name="withoutFatername", type="boolean", nullable=true)
     */
    private $withoutFatername;

    /**
     * @var string
     *
     * @ORM\Column(name="tariffPrice", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tariffPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="tariffFactor", type="integer", nullable=true)
     */
    private $tariffFactor;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="hideInTables", type="boolean", nullable=true)
     */
    private $hideInTables;

    /**
     * @var float
     *
     * @ORM\Column(name="priority", type="float", nullable=true)
     */
    private $priority;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var bool
     *
     * @ORM\Column(name="ToAllCruises", type="boolean", nullable=true)
     */
    private $toAllCruises;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cruiseDateStart", type="date", nullable=true)
     */
    private $cruiseDateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cruiseDateStop", type="date", nullable=true)
     */
    private $cruiseDateStop;

    /**
     * @var bool
     *
     * @ORM\Column(name="forAgency", type="boolean", nullable=true)
     */
    private $forAgency;

    /**
     * @var int
     *
     * @ORM\Column(name="ageLimit", type="integer", nullable=true)
     */
    private $ageLimit;
	
    /**
     * @var int
     *
     * @ORM\Column(name="placesLimit", type="integer", nullable=true)
     */
    private $placesLimit;

    /**
     * @var int
     *
     * @ORM\Column(name="calculationType", type="integer", nullable=true)
     */
    private $calculationType;

    /**
     * @var bool
     *
     * @ORM\Column(name="isInShop", type="boolean", nullable=true)
     */
    private $isInShop;

    /**
     * @var string
     *
     * @ORM\Column(name="code_1s", type="string", length=50)
     */
    private $code1s;
	
	
	/**
	 * @ORM\OneToMany(targetEntity="CruiseTariff", mappedBy="tariff")
	 */
	private $cruiseTariff;



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
     * @return Tariff
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
     * @return Tariff
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;

        return $this;
    }

    /**
     * Get validation
     *
     * @return boolean
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
     * @return Tariff
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
     * @return Tariff
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
     * @return Tariff
     */
    public function setValueFromCruise($valueFromCruise)
    {
        $this->valueFromCruise = $valueFromCruise;

        return $this;
    }

    /**
     * Get valueFromCruise
     *
     * @return boolean
     */
    public function getValueFromCruise()
    {
        return $this->valueFromCruise;
    }

    /**
     * Set isTariffChildren
     *
     * @param boolean $isTariffChildren
     *
     * @return Tariff
     */
    public function setIsTariffChildren($isTariffChildren)
    {
        $this->isTariffChildren = $isTariffChildren;

        return $this;
    }

    /**
     * Get isTariffChildren
     *
     * @return boolean
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
     * @return Tariff
     */
    public function setIsTariffPrivilege($isTariffPrivilege)
    {
        $this->isTariffPrivilege = $isTariffPrivilege;

        return $this;
    }

    /**
     * Get isTariffPrivilege
     *
     * @return boolean
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
     * @return Tariff
     */
    public function setIsTariffWithoutPlace($isTariffWithoutPlace)
    {
        $this->isTariffWithoutPlace = $isTariffWithoutPlace;

        return $this;
    }

    /**
     * Get isTariffWithoutPlace
     *
     * @return boolean
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
     * @return Tariff
     */
    public function setWithoutFatername($withoutFatername)
    {
        $this->withoutFatername = $withoutFatername;

        return $this;
    }

    /**
     * Get withoutFatername
     *
     * @return boolean
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
     * @return Tariff
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
     * @return Tariff
     */
    public function setTariffFactor($tariffFactor)
    {
        $this->tariffFactor = $tariffFactor;

        return $this;
    }

    /**
     * Get tariffFactor
     *
     * @return integer
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
     * @return Tariff
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
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
     * @return Tariff
     */
    public function setHideInTables($hideInTables)
    {
        $this->hideInTables = $hideInTables;

        return $this;
    }

    /**
     * Get hideInTables
     *
     * @return boolean
     */
    public function getHideInTables()
    {
        return $this->hideInTables;
    }

    /**
     * Set priority
     *
     * @param float $priority
     *
     * @return Tariff
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
     * @return Tariff
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
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
     * @return Tariff
     */
    public function setToAllCruises($toAllCruises)
    {
        $this->toAllCruises = $toAllCruises;

        return $this;
    }

    /**
     * Get toAllCruises
     *
     * @return boolean
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
     * @return Tariff
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
     * @return Tariff
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
     * @return Tariff
     */
    public function setForAgency($forAgency)
    {
        $this->forAgency = $forAgency;

        return $this;
    }

    /**
     * Get forAgency
     *
     * @return boolean
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
     * @return Tariff
     */
    public function setPlacesLimit($placesLimit)
    {
        $this->placesLimit = $placesLimit;

        return $this;
    }

    /**
     * Get placesLimit
     *
     * @return integer
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
     * @return Tariff
     */
    public function setCalculationType($calculationType)
    {
        $this->calculationType = $calculationType;

        return $this;
    }

    /**
     * Get calculationType
     *
     * @return integer
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
     * @return Tariff
     */
    public function setIsInShop($isInShop)
    {
        $this->isInShop = $isInShop;

        return $this;
    }

    /**
     * Get isInShop
     *
     * @return boolean
     */
    public function getIsInShop()
    {
        return $this->isInShop;
    }

    /**
     * Set ageLimit
     *
     * @param integer $ageLimit
     *
     * @return Tariff
     */
    public function setAgeLimit($ageLimit)
    {
        $this->ageLimit = $ageLimit;

        return $this;
    }

    /**
     * Get ageLimit
     *
     * @return integer
     */
    public function getAgeLimit()
    {
        return $this->ageLimit;
    }

    /**
     * Set code1s
     *
     * @param string $code1s
     *
     * @return Tariff
     */
    public function setCode1s($code1s)
    {
        $this->code1s = $code1s;

        return $this;
    }

    /**
     * Get code1s
     *
     * @return string
     */
    public function getCode1s()
    {
        return $this->code1s;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cruiseTariff = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cruiseTariff
     *
     * @param \CruiseBundle\Entity\CruiseTariff $cruiseTariff
     *
     * @return Tariff
     */
    public function addCruiseTariff(\CruiseBundle\Entity\CruiseTariff $cruiseTariff)
    {
        $this->cruiseTariff[] = $cruiseTariff;

        return $this;
    }

    /**
     * Remove cruiseTariff
     *
     * @param \CruiseBundle\Entity\CruiseTariff $cruiseTariff
     */
    public function removeCruiseTariff(\CruiseBundle\Entity\CruiseTariff $cruiseTariff)
    {
        $this->cruiseTariff->removeElement($cruiseTariff);
    }

    /**
     * Get cruiseTariff
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCruiseTariff()
    {
        return $this->cruiseTariff;
    }
}
