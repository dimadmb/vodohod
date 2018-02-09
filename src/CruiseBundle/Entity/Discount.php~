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
     * @ORM\Column(name="ageLimit", type="integer", nullable=true)
     */
    private $ageLimit;	
	
    /**
     * @var int
     *
     * @ORM\Column(name="placesLimit", type="integer")
     */
    private $placesLimit;


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
     * @var string
     *
     * @ORM\Column(name="code_1s", type="string", length=50)
     */
    private $code1s;


	
	/**
	 * @ORM\OneToMany(targetEntity="DiscountExclusion", mappedBy="discount")
	 */
	private $exclusions;

    /**
     * Get id
     *
     * @return integer
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
     * @return boolean
     */
    public function getValueFromCruise()
    {
        return $this->valueFromCruise;
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
     * @return boolean
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
     * @return boolean
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
     * @return integer
     */
    public function getPlacesLimit()
    {
        return $this->placesLimit;
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
     * @return boolean
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
     * @return boolean
     */
    public function getForAgenciesFromList()
    {
        return $this->forAgenciesFromList;
    }

    /**
     * Set ageLimit
     *
     * @param integer $ageLimit
     *
     * @return Discount
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
     * @return Discount
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
        $this->exclusions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add exclusion
     *
     * @param \CruiseBundle\Entity\DiscountExclusion $exclusion
     *
     * @return Discount
     */
    public function addExclusion(\CruiseBundle\Entity\DiscountExclusion $exclusion)
    {
        $this->exclusions[] = $exclusion;

        return $this;
    }

    /**
     * Remove exclusion
     *
     * @param \CruiseBundle\Entity\DiscountExclusion $exclusion
     */
    public function removeExclusion(\CruiseBundle\Entity\DiscountExclusion $exclusion)
    {
        $this->exclusions->removeElement($exclusion);
    }

    /**
     * Get exclusions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExclusions()
    {
        return $this->exclusions;
    }
}
