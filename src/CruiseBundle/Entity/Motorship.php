<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Motorship
 *
 * @ORM\Table(name="motorship")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\MotorshipRepository")
 */
class Motorship
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
     * @ORM\ManyToOne(targetEntity="MotorshipType", inversedBy="motorship")
     */
    private $motorshipType; 

    /**
     * @ORM\ManyToOne(targetEntity="MotorshipClass", inversedBy="motorship")
     */
    private $motorshipClass; 
	
	/**
	 * @ORM\OneToMany(targetEntity="MotorshipHall", mappedBy="motorship")
	 */
	private $hall;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

	/**
	* @ORM\ManyToOne(targetEntity="Region", inversedBy="motorship")
	*/
    private $region; 

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var float
     *
     * @ORM\Column(name="priority", type="float")
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="properties", type="text", nullable=true)
     */
    private $properties;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="operator_1s_code", type="string", length=64)
     */
    private $operator1sCode;

    /**
     * @var string
     *
     * @ORM\Column(name="parameter", type="string", length=255, nullable=true)
     */
    private $parameter;

    /**
     * @var string
     *
     * @ORM\Column(name="rooms_description", type="string", length=255, nullable=true)
     */
    private $roomsDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="manager", type="string", length=255, nullable=true)
     */
    private $manager;
	
	
	/**
	* @ORM\OneToMany(targetEntity="Cruise", mappedBy="motorship")
	*/
	private $cruise;	
	
	/**
	* @ORM\OneToMany(targetEntity="Room", mappedBy="motorship")
	*/
	private $room;
	
	
	/**
	 * @ORM\OneToMany(targetEntity="MotorshipRooms", mappedBy="motorship")
	 */
	private $motorshipRooms;	
	
	/**
	 * @ORM\OneToMany(targetEntity="Price", mappedBy="motorship")
	 */
	private $price;
	
	

	public function __construct()
	{
		$cruise = new ArrayCollection();
		$room = new ArrayCollection();
		$hall = new ArrayCollection();
		$motorshipRooms = new ArrayCollection();
	}

	public function __toString()
	{
		return $this->getName();
	}

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
     * @return Motorship
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
     * Set type
     *
     * @param integer $type
     *
     * @return Motorship
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
     * Set class
     *
     * @param integer $class
     *
     * @return Motorship
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return int
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Motorship
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
     * Set region
     *
     * @param integer $region
     *
     * @return Motorship
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return int
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Motorship
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Motorship
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
     * Set priority
     *
     * @param float $priority
     *
     * @return Motorship
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
     * Set description
     *
     * @param string $description
     *
     * @return Motorship
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set properties
     *
     * @param string $properties
     *
     * @return Motorship
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * Get properties
     *
     * @return string
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Motorship
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set operator1sCode
     *
     * @param string $operator1sCode
     *
     * @return Motorship
     */
    public function setOperator1sCode($operator1sCode)
    {
        $this->operator1sCode = $operator1sCode;

        return $this;
    }

    /**
     * Get operator1sCode
     *
     * @return string
     */
    public function getOperator1sCode()
    {
        return $this->operator1sCode;
    }

    /**
     * Set parameter
     *
     * @param string $parameter
     *
     * @return Motorship
     */
    public function setParameter($parameter)
    {
        $this->parameter = $parameter;

        return $this;
    }

    /**
     * Get parameter
     *
     * @return string
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Set roomsDescription
     *
     * @param string $roomsDescription
     *
     * @return Motorship
     */
    public function setRoomsDescription($roomsDescription)
    {
        $this->roomsDescription = $roomsDescription;

        return $this;
    }

    /**
     * Get roomsDescription
     *
     * @return string
     */
    public function getRoomsDescription()
    {
        return $this->roomsDescription;
    }

    /**
     * Set manager
     *
     * @param string $manager
     *
     * @return Motorship
     */
    public function setManager($manager)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * Get manager
     *
     * @return string
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Add cruise
     *
     * @param \CruiseBundle\Entity\Cruise $cruise
     *
     * @return Motorship
     */
    public function addCruise(\CruiseBundle\Entity\Cruise $cruise)
    {
        $this->cruise[] = $cruise;

        return $this;
    }

    /**
     * Remove cruise
     *
     * @param \CruiseBundle\Entity\Cruise $cruise
     */
    public function removeCruise(\CruiseBundle\Entity\Cruise $cruise)
    {
        $this->cruise->removeElement($cruise);
    }

    /**
     * Get cruise
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCruise()
    {
        return $this->cruise;
    }

    /**
     * Set motorshipType
     *
     * @param \CruiseBundle\Entity\MotorshipType $motorshipType
     *
     * @return Motorship
     */
    public function setMotorshipType(\CruiseBundle\Entity\MotorshipType $motorshipType = null)
    {
        $this->motorshipType = $motorshipType;

        return $this;
    }

    /**
     * Get motorshipType
     *
     * @return \CruiseBundle\Entity\MotorshipType
     */
    public function getMotorshipType()
    {
        return $this->motorshipType;
    }

    /**
     * Set motorshipClass
     *
     * @param \CruiseBundle\Entity\MotorshipClass $motorshipClass
     *
     * @return Motorship
     */
    public function setMotorshipClass(\CruiseBundle\Entity\MotorshipClass $motorshipClass = null)
    {
        $this->motorshipClass = $motorshipClass;

        return $this;
    }

    /**
     * Get motorshipClass
     *
     * @return \CruiseBundle\Entity\MotorshipClass
     */
    public function getMotorshipClass()
    {
        return $this->motorshipClass;
    }

    /**
     * Add room
     *
     * @param \CruiseBundle\Entity\Room $room
     *
     * @return Motorship
     */
    public function addRoom(\CruiseBundle\Entity\Room $room)
    {
        $this->room[] = $room;

        return $this;
    }

    /**
     * Remove room
     *
     * @param \CruiseBundle\Entity\Room $room
     */
    public function removeRoom(\CruiseBundle\Entity\Room $room)
    {
        $this->room->removeElement($room);
    }

    /**
     * Get room
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Add hall
     *
     * @param \CruiseBundle\Entity\MotorshipHall $hall
     *
     * @return Motorship
     */
    public function addHall(\CruiseBundle\Entity\MotorshipHall $hall)
    {
        $this->hall[] = $hall;

        return $this;
    }

    /**
     * Remove hall
     *
     * @param \CruiseBundle\Entity\MotorshipHall $hall
     */
    public function removeHall(\CruiseBundle\Entity\MotorshipHall $hall)
    {
        $this->hall->removeElement($hall);
    }

    /**
     * Get hall
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHall()
    {
        return $this->hall;
    }

    /**
     * Add motorshipRoom
     *
     * @param \CruiseBundle\Entity\MotorshipRooms $motorshipRoom
     *
     * @return Motorship
     */
    public function addMotorshipRoom(\CruiseBundle\Entity\MotorshipRooms $motorshipRoom)
    {
        $this->motorshipRooms[] = $motorshipRoom;

        return $this;
    }

    /**
     * Remove motorshipRoom
     *
     * @param \CruiseBundle\Entity\MotorshipRooms $motorshipRoom
     */
    public function removeMotorshipRoom(\CruiseBundle\Entity\MotorshipRooms $motorshipRoom)
    {
        $this->motorshipRooms->removeElement($motorshipRoom);
    }

    /**
     * Get motorshipRooms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMotorshipRooms()
    {
        return $this->motorshipRooms;
    }

    /**
     * Add price
     *
     * @param \CruiseBundle\Entity\Price $price
     *
     * @return Motorship
     */
    public function addPrice(\CruiseBundle\Entity\Price $price)
    {
        $this->price[] = $price;

        return $this;
    }

    /**
     * Remove price
     *
     * @param \CruiseBundle\Entity\Price $price
     */
    public function removePrice(\CruiseBundle\Entity\Price $price)
    {
        $this->price->removeElement($price);
    }

    /**
     * Get price
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrice()
    {
        return $this->price;
    }
}
