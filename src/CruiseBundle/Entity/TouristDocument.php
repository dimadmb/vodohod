<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TouristDocument
 *
 * @ORM\Table(name="tourist_document")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\TouristDocumentRepository")
 */
class TouristDocument
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
     * @ORM\Column(name="series", type="string", length=20, nullable=true)
     */
    private $series;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=20, nullable=true)
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255, nullable=true)
     */
    private $place;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Tourist", inversedBy="touristDocuments")
	 */
	private $tourist;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Contractor")
	 */
	private $contractor;
	
	/**
	 * @ORM\ManyToOne(targetEntity="TouristDocumentType")
	 */
	private $type;
	
	
    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;
	
	
	public function __toString()
	{
		return $this->series. " " . $this->number;
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
     * Set series
     *
     * @param string $series
     *
     * @return TouristDocument
     */
    public function setSeries($series)
    {
        $this->series = $series;

        return $this;
    }

    /**
     * Get series
     *
     * @return string
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return TouristDocument
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return TouristDocument
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
     * Set place
     *
     * @param string $place
     *
     * @return TouristDocument
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set tourist
     *
     * @param \CruiseBundle\Entity\Tourist $tourist
     *
     * @return TouristDocument
     */
    public function setTourist(\CruiseBundle\Entity\Tourist $tourist = null)
    {
        $this->tourist = $tourist;

        return $this;
    }

    /**
     * Get tourist
     *
     * @return \CruiseBundle\Entity\Tourist
     */
    public function getTourist()
    {
        return $this->tourist;
    }

    /**
     * Set type
     *
     * @param \CruiseBundle\Entity\TouristDocumentType $type
     *
     * @return TouristDocument
     */
    public function setType(\CruiseBundle\Entity\TouristDocumentType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \CruiseBundle\Entity\TouristDocumentType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set contractor
     *
     * @param \CruiseBundle\Entity\Contractor $contractor
     *
     * @return TouristDocument
     */
    public function setContractor(\CruiseBundle\Entity\Contractor $contractor = null)
    {
        $this->contractor = $contractor;

        return $this;
    }

    /**
     * Get contractor
     *
     * @return \CruiseBundle\Entity\Contractor
     */
    public function getContractor()
    {
        return $this->contractor;
    }



    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return TouristDocument
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
