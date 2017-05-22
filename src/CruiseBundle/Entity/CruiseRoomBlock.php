<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CruiseRoomBlock
 *
 * @ORM\Table(name="cruise_room_block")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\CruiseRoomBlockRepository")
 */
class CruiseRoomBlock
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
     * @ORM\ManyToOne(targetEntity="Room", inversedBy="roomBlock")
     */
    private $room;

    /**

     * @ORM\ManyToOne(targetEntity="Cruise", inversedBy="roomBlock")
     */
    private $cruise;

    /**
     * @var string
     *
     * @ORM\Column(name="code1s", type="string", length=255)
     */
    private $code1s;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time1s", type="datetime")
     */
    private $time1s;




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
     * Set code1s
     *
     * @param string $code1s
     *
     * @return CruiseRoomBlock
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
     * Set time1s
     *
     * @param \DateTime $time1s
     *
     * @return CruiseRoomBlock
     */
    public function setTime1s($time1s)
    {
        $this->time1s = $time1s;

        return $this;
    }

    /**
     * Get time1s
     *
     * @return \DateTime
     */
    public function getTime1s()
    {
        return $this->time1s;
    }

    /**
     * Set room
     *
     * @param \CruiseBundle\Entity\Room $room
     *
     * @return CruiseRoomBlock
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

    /**
     * Set cruise
     *
     * @param \CruiseBundle\Entity\Cruise $cruise
     *
     * @return CruiseRoomBlock
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
