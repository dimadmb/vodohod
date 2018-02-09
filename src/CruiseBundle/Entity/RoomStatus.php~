<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RoomStatus
 *
 * @ORM\Table(name="room_status")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\RoomStatusRepository")
 */
class RoomStatus
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
     * @var int
     *
     * @ORM\Column(name="reserve", type="integer")
     */
    private $reserve;
	
	
	/**
	 * @ORM\OneToMany(targetEntity="CruiseRoomStatus", mappedBy="status")
	 */
	private $roomStatus;


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
     * @return RoomStatus
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
     * Set autoFree
     *
     * @param integer $autoFree
     *
     * @return RoomStatus
     */
    public function setAutoFree($autoFree)
    {
        $this->autoFree = $autoFree;

        return $this;
    }

    /**
     * Get autoFree
     *
     * @return int
     */
    public function getAutoFree()
    {
        return $this->autoFree;
    }

    /**
     * Set reserve
     *
     * @param integer $reserve
     *
     * @return RoomStatus
     */
    public function setReserve($reserve)
    {
        $this->reserve = $reserve;

        return $this;
    }

    /**
     * Get reserve
     *
     * @return int
     */
    public function getReserve()
    {
        return $this->reserve;
    }

    /**
     * Set days
     *
     * @param integer $days
     *
     * @return RoomStatus
     */
    public function setDays($days)
    {
        $this->days = $days;

        return $this;
    }

    /**
     * Get days
     *
     * @return int
     */
    public function getDays()
    {
        return $this->days;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roomStatus = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add roomStatus
     *
     * @param \CruiseBundle\Entity\CruiseRoomStatus $roomStatus
     *
     * @return RoomStatus
     */
    public function addRoomStatus(\CruiseBundle\Entity\CruiseRoomStatus $roomStatus)
    {
        $this->roomStatus[] = $roomStatus;

        return $this;
    }

    /**
     * Remove roomStatus
     *
     * @param \CruiseBundle\Entity\CruiseRoomStatus $roomStatus
     */
    public function removeRoomStatus(\CruiseBundle\Entity\CruiseRoomStatus $roomStatus)
    {
        $this->roomStatus->removeElement($roomStatus);
    }

    /**
     * Get roomStatus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoomStatus()
    {
        return $this->roomStatus;
    }
}
