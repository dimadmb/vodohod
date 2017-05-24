<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cruise
 *
 * @ORM\Table(name="cruise")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\CruiseRepository")
 */
class Cruise
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="datetime")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_stop", type="datetime")
     */
    private $dateStop;

    /**
     * @var bool
     *
     * @ORM\Column(name="archives", type="boolean")
     */
    private $archives;

    /**
     * @var bool
     *
     * @ORM\Column(name="for_sale", type="boolean")
     */
    private $forSale;

	/**
	* @ORM\ManyToOne(targetEntity="Motorship", inversedBy="cruise")
	*/
	private $motorship;	
	
    /**
     * @var float
     *
     * @ORM\Column(name="price_koef", type="float")
     */
    private $priceKoef;

    /**
     * @var bool
     *
     * @ORM\Column(name="price_standart", type="boolean")
     */
    private $priceStandart;

    /**
     * @var float
     *
     * @ORM\Column(name="nds", type="float")
     */
    private $nds;

    /**
     * @var string
     *
     * @ORM\Column(name="price_days", type="decimal", precision=10, scale=2)
     */
    private $priceDays;

	/**
	* @ORM\ManyToOne(targetEntity="Region", inversedBy="cruise")
	*/
    private $region; 

    /**
     * @ORM\ManyToOne(targetEntity="CruiseClass", inversedBy="cruise")
     */
    private $cruiseClass; 

    /**
     * @var string
     *
     * @ORM\Column(name="code_1s", type="string", length=50)
     */
    private $code1s;

    /**
     * @var int
     *
     * @ORM\Column(name="availible_count", type="integer")
     */
    private $availibleCount;

    /**
     * @var bool
     *
     * @ORM\Column(name="time_public", type="boolean")
     */
    private $timePublic;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_registration", type="time")
     */
    private $timeRegistration;

    /**
     * @var string
     *
     * @ORM\Column(name="price_min", type="decimal", precision=10, scale=2)
     */
    private $priceMin;

    /**
     * @var bool
     *
     * @ORM\Column(name="no_discounts", type="boolean")
     */
    private $noDiscounts;

    /**
     * @var string
     *
     * @ORM\Column(name="text_categories", type="string", length=255)
     */
    private $textCategories;
	
	/**
	 * @ORM\ManyToMany(targetEntity="CruiseCategory", inversedBy="cruise")
	 */
	private $category;
	
	/**
	 * @ORM\OneToMany(targetEntity="CruiseDays", mappedBy="cruise")
	 */
	private $cruiseDays;	

	/**
	 * @ORM\OneToMany(targetEntity="CruiseRoomBlock", mappedBy="cruise")
	 */
	private $roomBlock;
	
	/**
	 * @ORM\OneToMany(targetEntity="Price", mappedBy="cruise")
	 */
	private $price;
	
	
	public function __construct()
	{
		$category = new ArrayCollection();
		$cruiseDays = new ArrayCollection();
		$price = new ArrayCollection();
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
     * @return Cruise
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
     * @return Cruise
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
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return Cruise
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateStop
     *
     * @param \DateTime $dateStop
     *
     * @return Cruise
     */
    public function setDateStop($dateStop)
    {
        $this->dateStop = $dateStop;

        return $this;
    }

    /**
     * Get dateStop
     *
     * @return \DateTime
     */
    public function getDateStop()
    {
        return $this->dateStop;
    }

    /**
     * Set archives
     *
     * @param boolean $archives
     *
     * @return Cruise
     */
    public function setArchives($archives)
    {
        $this->archives = $archives;

        return $this;
    }

    /**
     * Get archives
     *
     * @return bool
     */
    public function getArchives()
    {
        return $this->archives;
    }

    /**
     * Set forSale
     *
     * @param boolean $forSale
     *
     * @return Cruise
     */
    public function setForSale($forSale)
    {
        $this->forSale = $forSale;

        return $this;
    }

    /**
     * Get forSale
     *
     * @return bool
     */
    public function getForSale()
    {
        return $this->forSale;
    }

    /**
     * Set motorship
     *
     * @param integer $motorship
     *
     * @return Cruise
     */
    public function setMotorship($motorship)
    {
        $this->motorship = $motorship;

        return $this;
    }

    /**
     * Get motorship
     *
     * @return int
     */
    public function getMotorship()
    {
        return $this->motorship;
    }

    /**
     * Set priceKoef
     *
     * @param float $priceKoef
     *
     * @return Cruise
     */
    public function setPriceKoef($priceKoef)
    {
        $this->priceKoef = $priceKoef;

        return $this;
    }

    /**
     * Get priceKoef
     *
     * @return float
     */
    public function getPriceKoef()
    {
        return $this->priceKoef;
    }

    /**
     * Set priceStandart
     *
     * @param boolean $priceStandart
     *
     * @return Cruise
     */
    public function setPriceStandart($priceStandart)
    {
        $this->priceStandart = $priceStandart;

        return $this;
    }

    /**
     * Get priceStandart
     *
     * @return bool
     */
    public function getPriceStandart()
    {
        return $this->priceStandart;
    }

    /**
     * Set nds
     *
     * @param float $nds
     *
     * @return Cruise
     */
    public function setNds($nds)
    {
        $this->nds = $nds;

        return $this;
    }

    /**
     * Get nds
     *
     * @return float
     */
    public function getNds()
    {
        return $this->nds;
    }

    /**
     * Set priceDays
     *
     * @param string $priceDays
     *
     * @return Cruise
     */
    public function setPriceDays($priceDays)
    {
        $this->priceDays = $priceDays;

        return $this;
    }

    /**
     * Get priceDays
     *
     * @return string
     */
    public function getPriceDays()
    {
        return $this->priceDays;
    }

    /**
     * Set region
     *
     * @param integer $region
     *
     * @return Cruise
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
     * Set category
     *
     * @param integer $category
     *
     * @return Cruise
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return int
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set code1s
     *
     * @param string $code1s
     *
     * @return Cruise
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
     * Set availibleCount
     *
     * @param integer $availibleCount
     *
     * @return Cruise
     */
    public function setAvailibleCount($availibleCount)
    {
        $this->availibleCount = $availibleCount;

        return $this;
    }

    /**
     * Get availibleCount
     *
     * @return int
     */
    public function getAvailibleCount()
    {
        return $this->availibleCount;
    }

    /**
     * Set timePublic
     *
     * @param boolean $timePublic
     *
     * @return Cruise
     */
    public function setTimePublic($timePublic)
    {
        $this->timePublic = $timePublic;

        return $this;
    }

    /**
     * Get timePublic
     *
     * @return bool
     */
    public function getTimePublic()
    {
        return $this->timePublic;
    }

    /**
     * Set timeRegistration
     *
     * @param \DateTime $timeRegistration
     *
     * @return Cruise
     */
    public function setTimeRegistration($timeRegistration)
    {
        $this->timeRegistration = $timeRegistration;

        return $this;
    }

    /**
     * Get timeRegistration
     *
     * @return \DateTime
     */
    public function getTimeRegistration()
    {
        return $this->timeRegistration;
    }

    /**
     * Set priceMin
     *
     * @param string $priceMin
     *
     * @return Cruise
     */
    public function setPriceMin($priceMin)
    {
        $this->priceMin = $priceMin;

        return $this;
    }

    /**
     * Get priceMin
     *
     * @return string
     */
    public function getPriceMin()
    {
        return $this->priceMin;
    }

    /**
     * Set noDiscounts
     *
     * @param boolean $noDiscounts
     *
     * @return Cruise
     */
    public function setNoDiscounts($noDiscounts)
    {
        $this->noDiscounts = $noDiscounts;

        return $this;
    }

    /**
     * Get noDiscounts
     *
     * @return bool
     */
    public function getNoDiscounts()
    {
        return $this->noDiscounts;
    }

    /**
     * Set textCategoties
     *
     * @param string $textCategoties
     *
     * @return Cruise
     */
    public function setTextCategoties($textCategoties)
    {
        $this->textCategoties = $textCategoties;

        return $this;
    }

    /**
     * Get textCategoties
     *
     * @return string
     */
    public function getTextCategoties()
    {
        return $this->textCategoties;
    }

    /**
     * Set class
     *
     * @param integer $class
     *
     * @return Cruise
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return integer
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set textCategories
     *
     * @param string $textCategories
     *
     * @return Cruise
     */
    public function setTextCategories($textCategories)
    {
        $this->textCategories = $textCategories;

        return $this;
    }

    /**
     * Get textCategories
     *
     * @return string
     */
    public function getTextCategories()
    {
        return $this->textCategories;
    }

    /**
     * Set cruiseClass
     *
     * @param \CruiseBundle\Entity\CruiseClass $cruiseClass
     *
     * @return Cruise
     */
    public function setCruiseClass(\CruiseBundle\Entity\CruiseClass $cruiseClass = null)
    {
        $this->cruiseClass = $cruiseClass;

        return $this;
    }

    /**
     * Get cruiseClass
     *
     * @return \CruiseBundle\Entity\CruiseClass
     */
    public function getCruiseClass()
    {
        return $this->cruiseClass;
    }

    /**
     * Add category
     *
     * @param \CruiseBundle\Entity\CruiseCategory $category
     *
     * @return Cruise
     */
    public function addCategory(\CruiseBundle\Entity\CruiseCategory $category)
    {
        $this->category[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \CruiseBundle\Entity\CruiseCategory $category
     */
    public function removeCategory(\CruiseBundle\Entity\CruiseCategory $category)
    {
        $this->category->removeElement($category);
    }

    /**
     * Add cruiseDay
     *
     * @param \CruiseBundle\Entity\CruiseDays $cruiseDay
     *
     * @return Cruise
     */
    public function addCruiseDay(\CruiseBundle\Entity\CruiseDays $cruiseDay)
    {
        $this->cruiseDays[] = $cruiseDay;

        return $this;
    }

    /**
     * Remove cruiseDay
     *
     * @param \CruiseBundle\Entity\CruiseDays $cruiseDay
     */
    public function removeCruiseDay(\CruiseBundle\Entity\CruiseDays $cruiseDay)
    {
        $this->cruiseDays->removeElement($cruiseDay);
    }

    /**
     * Get cruiseDays
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCruiseDays()
    {
        return $this->cruiseDays;
    }

    /**
     * Add roomStatus
     *
     * @param \CruiseBundle\Entity\CruiseRoomStatus $roomStatus
     *
     * @return Cruise
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
     * @return Cruise
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

    /**
     * Add price
     *
     * @param \CruiseBundle\Entity\Price $price
     *
     * @return Cruise
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
