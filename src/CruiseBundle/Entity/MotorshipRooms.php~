<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MotorshipRooms
 *
 * @ORM\Table(name="motorship_rooms")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\MotorshipRoomsRepository")
 */
class MotorshipRooms
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
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @var float
     *
     * @ORM\Column(name="priority", type="float")
     */
    private $priority;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Motorship", inversedBy="motorshipRooms")
	 */
	private $motorship;	
	
    /**
     * @ORM\ManyToOne(targetEntity="RoomType", inversedBy="motorshipRooms")
     */
    private $roomType;  


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
     * @return MotorshipRooms
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
     * Set comment
     *
     * @param string $comment
     *
     * @return MotorshipRooms
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
     * Set priority
     *
     * @param float $priority
     *
     * @return MotorshipRooms
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
     * Set motorship
     *
     * @param \CruiseBundle\Entity\Motorship $motorship
     *
     * @return MotorshipRooms
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
     * Set roomType
     *
     * @param \CruiseBundle\Entity\RoomType $roomType
     *
     * @return MotorshipRooms
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
}
