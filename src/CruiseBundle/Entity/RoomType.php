<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * RoomType
 *
 * @ORM\Table(name="room_type")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\RoomTypeRepository")
 */
class RoomType
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var float
     *
     * @ORM\Column(name="priority", type="float")
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=10)
     */
    private $color;

    /**
     * @var int
     *
     * @ORM\Column(name="places_max", type="integer")
     */
    private $placesMax;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

	/**
	* @ORM\OneToMany(targetEntity="Room", mappedBy="roomType")
	*/
	private $room;
	
	/**
	* @ORM\OneToMany(targetEntity="MotorshipRooms", mappedBy="roomType")
	*/
	private $motorshipRooms;	
	
	/**
	* @ORM\OneToMany(targetEntity="Price", mappedBy="roomType")
	*/
	private $price;
	

	public function __construct()
	{
		$room = new ArrayCollection();
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
     * @return RoomType
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
     * Set code
     *
     * @param string $code
     *
     * @return RoomType
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
     * Set priority
     *
     * @param float $priority
     *
     * @return RoomType
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
     * Set color
     *
     * @param string $color
     *
     * @return RoomType
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set placesMax
     *
     * @param integer $placesMax
     *
     * @return RoomType
     */
    public function setPlacesMax($placesMax)
    {
        $this->placesMax = $placesMax;

        return $this;
    }

    /**
     * Get placesMax
     *
     * @return int
     */
    public function getPlacesMax()
    {
        return $this->placesMax;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return RoomType
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
     * Add room
     *
     * @param \CruiseBundle\Entity\Room $room
     *
     * @return RoomType
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
     * Add motorshipRoom
     *
     * @param \CruiseBundle\Entity\MotorshipRooms $motorshipRoom
     *
     * @return RoomType
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
     * @return RoomType
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
