<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tourist
 *
 * @ORM\Table(name="tourist")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\TouristRepository")
 */
class Tourist
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
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="fathername", type="string", length=255)
     */
    private $fathername;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_birth", type="date")
     */
    private $dateBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="tourist_1s_id", type="string", length=11, nullable=true)
     */
    private $tourist1sId;

    /**
     * @var bool
     *
     * @ORM\Column(name="tourist_1s_read", type="boolean", nullable=true)
     */
    private $tourist1sRead;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tourist_1s_read_time", type="datetime", nullable=true)
     */
    private $tourist1sReadTime;

    /**
     * @var string
     *
     * @ORM\Column(name="tourist_1s_code", type="string", length=50, nullable=true)
     */
    private $tourist1sCode;

    /**
     * @var string
     *
     * @ORM\Column(name="tourist_1s_barcode", type="string", length=50, nullable=true)
     */
    private $tourist1sBarcode;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="agency_id", type="integer", nullable=true)
     */
    private $agencyId;

    /**
     * @var int
     *
     * @ORM\Column(name="agency_id_temp", type="integer", nullable=true)
     */
    private $agencyIdTemp;

    /**
     * @var bool
     *
     * @ORM\Column(name="tourist_docs_full", type="boolean", nullable=true)
     */
    private $touristDocsFull;

	
	/**
	 * @ORM\OneToMany(targetEntity="TouristDocument", mappedBy="tourist")
	 */
	private $touristDocuments; 
	
	
	public function __toString()
	{
		return $this->lastname. " " . $this->name. " " . $this->fathername. " " .$this->dateBirth->format("d.m.Y");
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
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Tourist
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Tourist
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
     * Set fathername
     *
     * @param string $fathername
     *
     * @return Tourist
     */
    public function setFathername($fathername)
    {
        $this->fathername = $fathername;

        return $this;
    }

    /**
     * Get fathername
     *
     * @return string
     */
    public function getFathername()
    {
        return $this->fathername;
    }

    /**
     * Set dateBirth
     *
     * @param \DateTime $dateBirth
     *
     * @return Tourist
     */
    public function setDateBirth($dateBirth)
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }

    /**
     * Get dateBirth
     *
     * @return \DateTime
     */
    public function getDateBirth()
    {
        return $this->dateBirth;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Tourist
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Tourist
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Tourist
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Tourist
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set tourist1sId
     *
     * @param string $tourist1sId
     *
     * @return Tourist
     */
    public function setTourist1sId($tourist1sId)
    {
        $this->tourist1sId = $tourist1sId;

        return $this;
    }

    /**
     * Get tourist1sId
     *
     * @return string
     */
    public function getTourist1sId()
    {
        return $this->tourist1sId;
    }

    /**
     * Set tourist1sRead
     *
     * @param boolean $tourist1sRead
     *
     * @return Tourist
     */
    public function setTourist1sRead($tourist1sRead)
    {
        $this->tourist1sRead = $tourist1sRead;

        return $this;
    }

    /**
     * Get tourist1sRead
     *
     * @return bool
     */
    public function getTourist1sRead()
    {
        return $this->tourist1sRead;
    }

    /**
     * Set tourist1sReadTime
     *
     * @param \DateTime $tourist1sReadTime
     *
     * @return Tourist
     */
    public function setTourist1sReadTime($tourist1sReadTime)
    {
        $this->tourist1sReadTime = $tourist1sReadTime;

        return $this;
    }

    /**
     * Get tourist1sReadTime
     *
     * @return \DateTime
     */
    public function getTourist1sReadTime()
    {
        return $this->tourist1sReadTime;
    }

    /**
     * Set tourist1sCode
     *
     * @param string $tourist1sCode
     *
     * @return Tourist
     */
    public function setTourist1sCode($tourist1sCode)
    {
        $this->tourist1sCode = $tourist1sCode;

        return $this;
    }

    /**
     * Get tourist1sCode
     *
     * @return string
     */
    public function getTourist1sCode()
    {
        return $this->tourist1sCode;
    }

    /**
     * Set tourist1sBarcode
     *
     * @param string $tourist1sBarcode
     *
     * @return Tourist
     */
    public function setTourist1sBarcode($tourist1sBarcode)
    {
        $this->tourist1sBarcode = $tourist1sBarcode;

        return $this;
    }

    /**
     * Get tourist1sBarcode
     *
     * @return string
     */
    public function getTourist1sBarcode()
    {
        return $this->tourist1sBarcode;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Tourist
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set agencyId
     *
     * @param integer $agencyId
     *
     * @return Tourist
     */
    public function setAgencyId($agencyId)
    {
        $this->agencyId = $agencyId;

        return $this;
    }

    /**
     * Get agencyId
     *
     * @return int
     */
    public function getAgencyId()
    {
        return $this->agencyId;
    }

    /**
     * Set agencyIdTemp
     *
     * @param integer $agencyIdTemp
     *
     * @return Tourist
     */
    public function setAgencyIdTemp($agencyIdTemp)
    {
        $this->agencyIdTemp = $agencyIdTemp;

        return $this;
    }

    /**
     * Get agencyIdTemp
     *
     * @return int
     */
    public function getAgencyIdTemp()
    {
        return $this->agencyIdTemp;
    }

    /**
     * Set touristDocsFull
     *
     * @param boolean $touristDocsFull
     *
     * @return Tourist
     */
    public function setTouristDocsFull($touristDocsFull)
    {
        $this->touristDocsFull = $touristDocsFull;

        return $this;
    }

    /**
     * Get touristDocsFull
     *
     * @return bool
     */
    public function getTouristDocsFull()
    {
        return $this->touristDocsFull;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->touristDocuments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add touristDocument
     *
     * @param \CruiseBundle\Entity\TouristDocument $touristDocument
     *
     * @return Tourist
     */
    public function addTouristDocument(\CruiseBundle\Entity\TouristDocument $touristDocument)
    {
        $this->touristDocuments[] = $touristDocument;

        return $this;
    }

    /**
     * Remove touristDocument
     *
     * @param \CruiseBundle\Entity\TouristDocument $touristDocument
     */
    public function removeTouristDocument(\CruiseBundle\Entity\TouristDocument $touristDocument)
    {
        $this->touristDocuments->removeElement($touristDocument);
    }

    /**
     * Get touristDocuments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTouristDocuments()
    {
        return $this->touristDocuments;
    }
}
