<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\RoomRepository")
 */
class Room
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
     * @ORM\Column(name="number", type="string", length=255)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="RoomType", inversedBy="room")
     */
    private $roomType;  

    /**
     * @ORM\ManyToOne(targetEntity="Motorship", inversedBy="room")
     */
    private $motorship;

    /**
     * @ORM\ManyToOne(targetEntity="Deck", inversedBy="room")
     */
    private $deck;

	/**
	 * @ORM\OneToMany(targetEntity="CruiseRoomStatus", mappedBy="room")
	 */
	private $roomStatus;

	/**
	 * @ORM\OneToMany(targetEntity="CruiseRoomBlock", mappedBy="room")
	 */
	private $roomBlock;
	 
    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="smaller", type="integer")
     */
    private $smaller;

    /**
     * @var float
     *
     * @ORM\Column(name="priority", type="float")
     */
    private $priority;

	
	public function __construct()
	{
		$roomStatus = new ArrayCollection();
	}

	public function __toString()
	{
		return $this->getNumber();
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
     * Set number
     *
     * @param string $number
     *
     * @return Room
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Room
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
     * Set status
     *
     * @param integer $status
     *
     * @return Room
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set smaller
     *
     * @param integer $smaller
     *
     * @return Room
     */
    public function setSmaller($smaller)
    {
        $this->smaller = $smaller;

        return $this;
    }

    /**
     * Get smaller
     *
     * @return int
     */
    public function getSmaller()
    {
        return $this->smaller;
    }

    /**
     * Set priority
     *
     * @param float $priority
     *
     * @return Room
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
     * Set roomType
     *
     * @param \CruiseBundle\Entity\RoomType $roomType
     *
     * @return Room
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
     * Set motorship
     *
     * @param \CruiseBundle\Entity\Motorship $motorship
     *
     * @return Room
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
     * @return Room
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
     * Add roomStatus
     *
     * @param \CruiseBundle\Entity\CruiseRoomStatus $roomStatus
     *
     * @return Room
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

    /**
     * Add roomBlock
     *
     * @param \CruiseBundle\Entity\CruiseRoomBlock $roomBlock
     *
     * @return Room
     */
    public function addRoomBlock(\CruiseBundle\Entity\CruiseRoomBlock $roomBlock)
    {
        $this->roomBlock[] = $roomBlock;

        return $this;
    }

    /**
     * Remove roomBlock
     *
     * @param \CruiseBundle\Entity\CruiseRoomBlock $roomBlock
     */
    public function removeRoomBlock(\CruiseBundle\Entity\CruiseRoomBlock $roomBlock)
    {
        $this->roomBlock->removeElement($roomBlock);
    }

    /**
     * Get roomBlock
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoomBlock()
    {
        return $this->roomBlock;
    }
}
