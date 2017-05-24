<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Region
 *
 * @ORM\Table(name="region")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\RegionRepository")
 */
class Region
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
     * @var float
     *
     * @ORM\Column(name="priority", type="float")
     */
    private $priority;

    /**
     * @var int
     *
     * @ORM\Column(name="price_type_tariff", type="integer")
     */
    private $priceTypeTariff;

    /**
     * @var int
     *
     * @ORM\Column(name="price_type_add_place", type="integer")
     */
    private $priceTypeAddPlace;

    /**
     * @var int
     *
     * @ORM\Column(name="price_type_discount", type="integer")
     */
    private $priceTypeDiscount;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;
	
	
	/**
	* @ORM\OneToMany(targetEntity="Cruise", mappedBy="region")
	*/
	private $cruise;	
	
	/**
	* @ORM\OneToMany(targetEntity="Motorship", mappedBy="region")
	*/
	private $motorship;
	
	public function __construct()
	{
		$cruise = new ArrayCollection();
		$motorship = new ArrayCollection();
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
     * @return Region
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
     * Set priority
     *
     * @param float $priority
     *
     * @return Region
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
     * Set priceTypeTariff
     *
     * @param integer $priceTypeTariff
     *
     * @return Region
     */
    public function setPriceTypeTariff($priceTypeTariff)
    {
        $this->priceTypeTariff = $priceTypeTariff;

        return $this;
    }

    /**
     * Get priceTypeTariff
     *
     * @return int
     */
    public function getPriceTypeTariff()
    {
        return $this->priceTypeTariff;
    }

    /**
     * Set priceTypeAddPlace
     *
     * @param integer $priceTypeAddPlace
     *
     * @return Region
     */
    public function setPriceTypeAddPlace($priceTypeAddPlace)
    {
        $this->priceTypeAddPlace = $priceTypeAddPlace;

        return $this;
    }

    /**
     * Get priceTypeAddPlace
     *
     * @return int
     */
    public function getPriceTypeAddPlace()
    {
        return $this->priceTypeAddPlace;
    }

    /**
     * Set priceTypeDiscount
     *
     * @param integer $priceTypeDiscount
     *
     * @return Region
     */
    public function setPriceTypeDiscount($priceTypeDiscount)
    {
        $this->priceTypeDiscount = $priceTypeDiscount;

        return $this;
    }

    /**
     * Get priceTypeDiscount
     *
     * @return int
     */
    public function getPriceTypeDiscount()
    {
        return $this->priceTypeDiscount;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Region
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
     * Add cruise
     *
     * @param \CruiseBundle\Entity\Cruise $cruise
     *
     * @return Region
     */
    public function addCruise(\CruiseBundle\Entity\Cruise $cruise)
    {
        $this->cruise[] = $cruise;

        return $this;
    }

    /**
     * Remove cruise
     *
     * @param \CruiseBundle\Entity\Cruise $cruise
     */
    public function removeCruise(\CruiseBundle\Entity\Cruise $cruise)
    {
        $this->cruise->removeElement($cruise);
    }

    /**
     * Get cruise
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCruise()
    {
        return $this->cruise;
    }

    /**
     * Add motorship
     *
     * @param \CruiseBundle\Entity\Motorship $motorship
     *
     * @return Region
     */
    public function addMotorship(\CruiseBundle\Entity\Motorship $motorship)
    {
        $this->motorship[] = $motorship;

        return $this;
    }

    /**
     * Remove motorship
     *
     * @param \CruiseBundle\Entity\Motorship $motorship
     */
    public function removeMotorship(\CruiseBundle\Entity\Motorship $motorship)
    {
        $this->motorship->removeElement($motorship);
    }

    /**
     * Get motorship
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMotorship()
    {
        return $this->motorship;
    }
}
