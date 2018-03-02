<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderItemPlace
 *
 * @ORM\Table(name="order_item_place")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\OrderItemPlaceRepository")
 */
class OrderItemPlace
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
     * @var int
     *
     * @ORM\Column(name="place", type="integer", nullable=true)
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="price_manual", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $priceManual;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="summ", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $summ;

    /**
     * @var string
     *
     * @ORM\Column(name="summ_discount_bonus", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $summDiscountBonus;

    /**
     * @var string
     *
     * @ORM\Column(name="summ_discount", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $summDiscount;

    /**
     * @var bool
     *
     * @ORM\Column(name="place_main", type="boolean", nullable=true)
     */
    private $placeMain;

    /**
     * @var bool
     *
     * @ORM\Column(name="place_add", type="boolean", nullable=true)
     */
    private $placeAdd;

    /**
     * @var bool
     *
     * @ORM\Column(name="place_without_place", type="boolean", nullable=true)
     */
    private $placeWithoutPlace;

    /**
     * @var string
     *
     * @ORM\Column(name="voucher_number", type="string", length=20, nullable=true)
     */
    private $voucherNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="nds_id", type="integer", nullable=true)
     */
    private $ndsId;
	
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="OrderItem", inversedBy="orderItemPlaces")
	 * @ORM\JoinColumn(onDelete="CASCADE")	 
	 */
	private $orderItem;	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Tourist")
	 */
	private $tourist;
	
		
	/**
	 * @ORM\ManyToOne(targetEntity="Tariff")
	 */
	private $tariff;
	
	


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
     * Set place
     *
     * @param integer $place
     *
     * @return OrderItemPlace
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return int
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set priceManual
     *
     * @param string $priceManual
     *
     * @return OrderItemPlace
     */
    public function setPriceManual($priceManual)
    {
        $this->priceManual = $priceManual;

        return $this;
    }

    /**
     * Get priceManual
     *
     * @return string
     */
    public function getPriceManual()
    {
        return $this->priceManual;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return OrderItemPlace
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set summ
     *
     * @param string $summ
     *
     * @return OrderItemPlace
     */
    public function setSumm($summ)
    {
        $this->summ = $summ;

        return $this;
    }

    /**
     * Get summ
     *
     * @return string
     */
    public function getSumm()
    {
        return $this->summ;
    }

    /**
     * Set summDiscountBonus
     *
     * @param string $summDiscountBonus
     *
     * @return OrderItemPlace
     */
    public function setSummDiscountBonus($summDiscountBonus)
    {
        $this->summDiscountBonus = $summDiscountBonus;

        return $this;
    }

    /**
     * Get summDiscountBonus
     *
     * @return string
     */
    public function getSummDiscountBonus()
    {
        return $this->summDiscountBonus;
    }

    /**
     * Set summDiscount
     *
     * @param string $summDiscount
     *
     * @return OrderItemPlace
     */
    public function setSummDiscount($summDiscount)
    {
        $this->summDiscount = $summDiscount;

        return $this;
    }

    /**
     * Get summDiscount
     *
     * @return string
     */
    public function getSummDiscount()
    {
        return $this->summDiscount;
    }

    /**
     * Set placeMain
     *
     * @param boolean $placeMain
     *
     * @return OrderItemPlace
     */
    public function setPlaceMain($placeMain)
    {
        $this->placeMain = $placeMain;

        return $this;
    }

    /**
     * Get placeMain
     *
     * @return bool
     */
    public function getPlaceMain()
    {
        return $this->placeMain;
    }

    /**
     * Set placeAdd
     *
     * @param boolean $placeAdd
     *
     * @return OrderItemPlace
     */
    public function setPlaceAdd($placeAdd)
    {
        $this->placeAdd = $placeAdd;

        return $this;
    }

    /**
     * Get placeAdd
     *
     * @return bool
     */
    public function getPlaceAdd()
    {
        return $this->placeAdd;
    }

    /**
     * Set placeWithoutPlace
     *
     * @param boolean $placeWithoutPlace
     *
     * @return OrderItemPlace
     */
    public function setPlaceWithoutPlace($placeWithoutPlace)
    {
        $this->placeWithoutPlace = $placeWithoutPlace;

        return $this;
    }

    /**
     * Get placeWithoutPlace
     *
     * @return bool
     */
    public function getPlaceWithoutPlace()
    {
        return $this->placeWithoutPlace;
    }

    /**
     * Set voucherNumber
     *
     * @param string $voucherNumber
     *
     * @return OrderItemPlace
     */
    public function setVoucherNumber($voucherNumber)
    {
        $this->voucherNumber = $voucherNumber;

        return $this;
    }

    /**
     * Get voucherNumber
     *
     * @return string
     */
    public function getVoucherNumber()
    {
        return $this->voucherNumber;
    }

    /**
     * Set ndsId
     *
     * @param integer $ndsId
     *
     * @return OrderItemPlace
     */
    public function setNdsId($ndsId)
    {
        $this->ndsId = $ndsId;

        return $this;
    }

    /**
     * Get ndsId
     *
     * @return int
     */
    public function getNdsId()
    {
        return $this->ndsId;
    }

    /**
     * Set orderItem
     *
     * @param \CruiseBundle\Entity\OrderItem $orderItem
     *
     * @return OrderItemPlace
     */
    public function setOrderItem(\CruiseBundle\Entity\OrderItem $orderItem = null)
    {
        $this->orderItem = $orderItem;

        return $this;
    }

    /**
     * Get orderItem
     *
     * @return \CruiseBundle\Entity\OrderItem
     */
    public function getOrderItem()
    {
        return $this->orderItem;
    }

    /**
     * Set tourist
     *
     * @param \CruiseBundle\Entity\Tourist $tourist
     *
     * @return OrderItemPlace
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
     * Set tariff
     *
     * @param \CruiseBundle\Entity\Tariff $tariff
     *
     * @return OrderItemPlace
     */
    public function setTariff(\CruiseBundle\Entity\Tariff $tariff = null)
    {
        $this->tariff = $tariff;

        return $this;
    }

    /**
     * Get tariff
     *
     * @return \CruiseBundle\Entity\Tariff
     */
    public function getTariff()
    {
        return $this->tariff;
    }
}
