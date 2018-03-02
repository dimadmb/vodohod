<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderService
 *
 * @ORM\Table(name="order_service")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\OrderServiceRepository")
 */
class OrderService
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
     * @ORM\Column(name="servise_id", type="string", length=255, nullable=true)
     */
    private $serviseId;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="count", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $count;

    /**
     * @var string
     *
     * @ORM\Column(name="summ", type="decimal", precision=10, scale=2)
     */
    private $summ;

    /**
     * @var string
     *
     * @ORM\Column(name="nds", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $nds;

    /**
     * @var int
     *
     * @ORM\Column(name="nds_id", type="integer", nullable=true)
     */
    private $ndsId;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Ordering")
	 * @ORM\JoinColumn(onDelete="CASCADE")	 
	 */
	private $order;	


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
     * Set serviseId
     *
     * @param string $serviseId
     *
     * @return OrderService
     */
    public function setServiseId($serviseId)
    {
        $this->serviseId = $serviseId;

        return $this;
    }

    /**
     * Get serviseId
     *
     * @return string
     */
    public function getServiseId()
    {
        return $this->serviseId;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return OrderService
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
     * Set count
     *
     * @param string $count
     *
     * @return OrderService
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return string
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set summ
     *
     * @param string $summ
     *
     * @return OrderService
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
     * Set nds
     *
     * @param string $nds
     *
     * @return OrderService
     */
    public function setNds($nds)
    {
        $this->nds = $nds;

        return $this;
    }

    /**
     * Get nds
     *
     * @return string
     */
    public function getNds()
    {
        return $this->nds;
    }

    /**
     * Set ndsId
     *
     * @param integer $ndsId
     *
     * @return OrderService
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
     * Set order
     *
     * @param \CruiseBundle\Entity\Ordering $order
     *
     * @return OrderService
     */
    public function setOrder(\CruiseBundle\Entity\Ordering $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \CruiseBundle\Entity\Ordering
     */
    public function getOrder()
    {
        return $this->order;
    }
}
