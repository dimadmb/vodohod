<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderDiscount
 *
 * @ORM\Table(name="order_discount")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\OrderDiscountRepository")
 */
class OrderDiscount
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
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="plus", type="boolean", nullable=true)
     */
    private $plus;

    /**
     * @var int
     *
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    private $priority;

    /**
     * @var int
     *
     * @ORM\Column(name="value", type="integer", nullable=true)
     */
    private $value;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Ordering")
	 * @ORM\JoinColumn(onDelete="CASCADE")
	 */
	private $order;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Discount")
	 */
	private $discount;


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
     * Set type
     *
     * @param integer $type
     *
     * @return OrderDiscount
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set plus
     *
     * @param boolean $plus
     *
     * @return OrderDiscount
     */
    public function setPlus($plus)
    {
        $this->plus = $plus;

        return $this;
    }

    /**
     * Get plus
     *
     * @return bool
     */
    public function getPlus()
    {
        return $this->plus;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return OrderDiscount
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set value
     *
     * @param integer $value
     *
     * @return OrderDiscount
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set order
     *
     * @param \CruiseBundle\Entity\Ordering $order
     *
     * @return OrderDiscount
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

    /**
     * Set discount
     *
     * @param \CruiseBundle\Entity\Discount $discount
     *
     * @return OrderDiscount
     */
    public function setDiscount(\CruiseBundle\Entity\Discount $discount = null)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return \CruiseBundle\Entity\Discount
     */
    public function getDiscount()
    {
        return $this->discount;
    }
}
