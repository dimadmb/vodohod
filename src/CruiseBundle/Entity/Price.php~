<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Price
 *
 * @ORM\Table(name="price", uniqueConstraints={@ORM\UniqueConstraint(name="price_uniq", columns={"active","additional","persons", "year","motorship_id","deck_id","room_type_id","room_placing_id","cruise_id"})})
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\PriceRepository")
 */
class Price
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
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity="Motorship", inversedBy="price")
     */
    private $motorship;

    /**
     * @ORM\ManyToOne(targetEntity="Deck", inversedBy="price")
     */
    private $deck;

    /**
     * @ORM\ManyToOne(targetEntity="RoomType", inversedBy="price")
     */
    private $roomType;

    /**
     * @ORM\ManyToOne(targetEntity="RoomPlacing", inversedBy="price")
     */
    private $roomPlacing;

    /**
     * @ORM\ManyToOne(targetEntity="Cruise", inversedBy="price")
     */
    private $cruise;



    /**
     * @var bool
     *
     * @ORM\Column(name="additional", type="boolean")
     */
    private $additional;

    /**
     * @var bool
     *
     * @ORM\Column(name="persons", type="boolean")
     */
    private $persons;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="decimal", precision=10, scale=2)
     */
    private $value;

    /**
     * @var bool
     *
     * @ORM\Column(name="children", type="boolean")
     */
    private $children;

    /**
     * @var bool
     *
     * @ORM\Column(name="privilege", type="boolean")
     */
    private $privilege;

    /**
     * @var int
     *
     * @ORM\Column(name="addPersonCount", type="integer")
     */
    private $addPersonCount;

    /**
     * @var int
     *
     * @ORM\Column(name="addPersonType", type="integer")
     */
    private $addPersonType;

    /**
     * @var string
     *
     * @ORM\Column(name="addPersonValue", type="decimal", precision=10, scale=2)
     */
    private $addPersonValue;

    /**
     * @var int
     *
     * @ORM\Column(name="addPersonFactor", type="integer")
     */
    private $addPersonFactor;




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
     * @return Price
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
     * Set active
     *
     * @param boolean $active
     *
     * @return Price
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
     * Set year
     *
     * @param integer $year
     *
     * @return Price
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set additional
     *
     * @param boolean $additional
     *
     * @return Price
     */
    public function setAdditional($additional)
    {
        $this->additional = $additional;

        return $this;
    }

    /**
     * Get additional
     *
     * @return boolean
     */
    public function getAdditional()
    {
        return $this->additional;
    }

    /**
     * Set persons
     *
     * @param boolean $persons
     *
     * @return Price
     */
    public function setPersons($persons)
    {
        $this->persons = $persons;

        return $this;
    }

    /**
     * Get persons
     *
     * @return boolean
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Price
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
     * Set children
     *
     * @param boolean $children
     *
     * @return Price
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Get children
     *
     * @return boolean
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set privilege
     *
     * @param boolean $privilege
     *
     * @return Price
     */
    public function setPrivilege($privilege)
    {
        $this->privilege = $privilege;

        return $this;
    }

    /**
     * Get privilege
     *
     * @return boolean
     */
    public function getPrivilege()
    {
        return $this->privilege;
    }

    /**
     * Set addPersonCount
     *
     * @param integer $addPersonCount
     *
     * @return Price
     */
    public function setAddPersonCount($addPersonCount)
    {
        $this->addPersonCount = $addPersonCount;

        return $this;
    }

    /**
     * Get addPersonCount
     *
     * @return integer
     */
    public function getAddPersonCount()
    {
        return $this->addPersonCount;
    }

    /**
     * Set addPersonType
     *
     * @param integer $addPersonType
     *
     * @return Price
     */
    public function setAddPersonType($addPersonType)
    {
        $this->addPersonType = $addPersonType;

        return $this;
    }

    /**
     * Get addPersonType
     *
     * @return integer
     */
    public function getAddPersonType()
    {
        return $this->addPersonType;
    }

    /**
     * Set addPersonValue
     *
     * @param string $addPersonValue
     *
     * @return Price
     */
    public function setAddPersonValue($addPersonValue)
    {
        $this->addPersonValue = $addPersonValue;

        return $this;
    }

    /**
     * Get addPersonValue
     *
     * @return string
     */
    public function getAddPersonValue()
    {
        return $this->addPersonValue;
    }

    /**
     * Set addPersonFactor
     *
     * @param integer $addPersonFactor
     *
     * @return Price
     */
    public function setAddPersonFactor($addPersonFactor)
    {
        $this->addPersonFactor = $addPersonFactor;

        return $this;
    }

    /**
     * Get addPersonFactor
     *
     * @return integer
     */
    public function getAddPersonFactor()
    {
        return $this->addPersonFactor;
    }

    /**
     * Set motorship
     *
     * @param \CruiseBundle\Entity\Motorship $motorship
     *
     * @return Price
     */
    public function setMotorship(\CruiseBundle\Entity\Motorship $motorship = null)
    {
        $this->motorship = $motorship;

        return $this;
    }

    /**
     * Get motorship
     *
     * @return \CruiseBundle\Entity\Motorship
     */
    public function getMotorship()
    {
        return $this->motorship;
    }

    /**
     * Set deck
     *
     * @param \CruiseBundle\Entity\Deck $deck
     *
     * @return Price
     */
    public function setDeck(\CruiseBundle\Entity\Deck $deck = null)
    {
        $this->deck = $deck;

        return $this;
    }

    /**
     * Get deck
     *
     * @return \CruiseBundle\Entity\Deck
     */
    public function getDeck()
    {
        return $this->deck;
    }

    /**
     * Set roomType
     *
     * @param \CruiseBundle\Entity\RoomType $roomType
     *
     * @return Price
     */
    public function setRoomType(\CruiseBundle\Entity\RoomType $roomType = null)
    {
        $this->roomType = $roomType;

        return $this;
    }

    /**
     * Get roomType
     *
     * @return \CruiseBundle\Entity\RoomType
     */
    public function getRoomType()
    {
        return $this->roomType;
    }

    /**
     * Set roomPlacing
     *
     * @param \CruiseBundle\Entity\RoomPlacing $roomPlacing
     *
     * @return Price
     */
    public function setRoomPlacing(\CruiseBundle\Entity\RoomPlacing $roomPlacing = null)
    {
        $this->roomPlacing = $roomPlacing;

        return $this;
    }

    /**
     * Get roomPlacing
     *
     * @return \CruiseBundle\Entity\RoomPlacing
     */
    public function getRoomPlacing()
    {
        return $this->roomPlacing;
    }

    /**
     * Set cruise
     *
     * @param \CruiseBundle\Entity\Cruise $cruise
     *
     * @return Price
     */
    public function setCruise(\CruiseBundle\Entity\Cruise $cruise = null)
    {
        $this->cruise = $cruise;

        return $this;
    }

    /**
     * Get cruise
     *
     * @return \CruiseBundle\Entity\Cruise
     */
    public function getCruise()
    {
        return $this->cruise;
    }
}
