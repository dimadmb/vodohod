<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CruiseRoomStatus
 *
 * @ORM\Table(name="cruise_room_status")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\CruiseRoomStatusRepository")
 */
class CruiseRoomStatus
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**

     * @ORM\ManyToOne(targetEntity="RoomStatus", inversedBy="roomStatus")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="Room", inversedBy="roomStatus")
     */
    private $room;

    /**
     * @var string
     *
     * @ORM\Column(name="code1s", type="string", length=255)
     */
    private $code1s;



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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return CruiseRoomStatus
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set code1s
     *
     * @param string $code1s
     *
     * @return CruiseRoomStatus
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
     * Set status
     *
     * @param \CruiseBundle\Entity\RoomStatus $status
     *
     * @return CruiseRoomStatus
     */
    public function setStatus(\CruiseBundle\Entity\RoomStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \CruiseBundle\Entity\RoomStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set room
     *
     * @param \CruiseBundle\Entity\Room $room
     *
     * @return CruiseRoomStatus
     */
    public function setRoom(\CruiseBundle\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \CruiseBundle\Entity\Room
     */
    public function getRoom()
    {
        return $this->room;
    }
}
