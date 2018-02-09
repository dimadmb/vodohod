<?php

namespace BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MotorshipRoomImage
 *
 * @ORM\Table(name="motorship_room_image")
 * @ORM\Entity(repositoryClass="BaseBundle\Repository\MotorshipRoomImageRepository")
 */
class MotorshipRoomImage
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;


    /**
     * @var int
     *
     * @ORM\Column(name="sort", type="integer", nullable=true)
     */
    private $sort;

	/**
	 * @ORM\ManyToMany(targetEntity="Image")
	 * @ORM\OrderBy({"sort" = "ASC", "id" = "ASC"})
	 * @ORM\JoinTable(name="motorship_room_image_image", joinColumns={@ORM\JoinColumn(name="motorship_room_id",
		referencedColumnName="id", onDelete="CASCADE")},
	 * inverseJoinColumns={@ORM\JoinColumn(name="image_id",
	referencedColumnName="id", onDelete="CASCADE")})
	 */	
    private $file;

    /**
     * @var int
     *
     * @ORM\Column(name="motorship_id", type="integer")
     */
    private $motorship;
	
    /**
     * @var int
     *
     * @ORM\Column(name="deck_id", type="integer")
     */
    private $deck;

    /**
     * @var int
     *
     * @ORM\Column(name="room_type_id", type="integer")
     */
    private $roomType;	
	
	



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
     * @return MotorshipRoomImage
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
     * Set sort
     *
     * @param integer $sort
     *
     * @return MotorshipRoomImage
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return integer
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set motorship
     *
     * @param integer $motorship
     *
     * @return MotorshipRoomImage
     */
    public function setMotorship($motorship)
    {
        $this->motorship = $motorship;

        return $this;
    }

    /**
     * Get motorship
     *
     * @return integer
     */
    public function getMotorship()
    {
        return $this->motorship;
    }

    /**
     * Set deck
     *
     * @param integer $deck
     *
     * @return MotorshipRoomImage
     */
    public function setDeck($deck)
    {
        $this->deck = $deck;

        return $this;
    }

    /**
     * Get deck
     *
     * @return integer
     */
    public function getDeck()
    {
        return $this->deck;
    }

    /**
     * Set roomType
     *
     * @param integer $roomType
     *
     * @return MotorshipRoomImage
     */
    public function setRoomType($roomType)
    {
        $this->roomType = $roomType;

        return $this;
    }

    /**
     * Get roomType
     *
     * @return integer
     */
    public function getRoomType()
    {
        return $this->roomType;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->file = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add file
     *
     * @param \BaseBundle\Entity\Image $file
     *
     * @return MotorshipRoomImage
     */
    public function addFile(\BaseBundle\Entity\Image $file)
    {
        $this->file[] = $file;

        return $this;
    }

    /**
     * Remove file
     *
     * @param \BaseBundle\Entity\Image $file
     */
    public function removeFile(\BaseBundle\Entity\Image $file)
    {
        $this->file->removeElement($file);
    }
	
    /**
     * Remove file
     *
     * @param \BaseBundle\Entity\Image $file
     */
    public function removeAllFile()
    {
        $this->file = [];
    }	

    /**
     * Get file
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFile()
    {
        return $this->file;
    }
}
