<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderItem
 *
 * @ORM\Table(name="order_item")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\OrderItemRepository")
 */
class OrderItem
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
	 * @ORM\ManyToOne(targetEntity="Ordering", inversedBy="orderItems")
	 * @ORM\JoinColumn(onDelete="CASCADE")
	 */
	private $order;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Room")
	 */
	private $room;
	
	/**
	 * @ORM\ManyToOne(targetEntity="RoomPlacing")
	 */
	private $roomPlace;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Price")
	 */
	private $price;
	
	/**
	 * @ORM\OneToMany(targetEntity="OrderItemPlace", mappedBy="orderItem")
	 */
	private $orderItemPlaces;


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
     * Set order
     *
     * @param \CruiseBundle\Entity\Ordering $order
     *
     * @return OrderItem
     */
    public function setOrder(\CruiseBundle\Entity\Ordering $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \CruiseBundle\Entity\Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set room
     *
     * @param \CruiseBundle\Entity\Room $room
     *
     * @return OrderItem
     */
    public function setRoom(\CruiseBundle\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \CruiseBundle\Entity\Room
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set roomPlace
     *
     * @param \CruiseBundle\Entity\RoomPlacing $roomPlace
     *
     * @return OrderItem
     */
    public function setRoomPlace(\CruiseBundle\Entity\RoomPlacing $roomPlace = null)
    {
        $this->roomPlace = $roomPlace;

        return $this;
    }

    /**
     * Get roomPlace
     *
     * @return \CruiseBundle\Entity\RoomPlacing
     */
    public function getRoomPlace()
    {
        return $this->roomPlace;
    }

    /**
     * Set price
     *
     * @param \CruiseBundle\Entity\Price $price
     *
     * @return OrderItem
     */
    public function setPrice(\CruiseBundle\Entity\Price $price = null)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return \CruiseBundle\Entity\Price
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderItemPlaces = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add orderItemPlace
     *
     * @param \CruiseBundle\Entity\OrderItemPlace $orderItemPlace
     *
     * @return OrderItem
     */
    public function addOrderItemPlace(\CruiseBundle\Entity\OrderItemPlace $orderItemPlace)
    {
        $this->orderItemPlaces[] = $orderItemPlace;

        return $this;
    }

    /**
     * Remove orderItemPlace
     *
     * @param \CruiseBundle\Entity\OrderItemPlace $orderItemPlace
     */
    public function removeOrderItemPlace(\CruiseBundle\Entity\OrderItemPlace $orderItemPlace)
    {
        $this->orderItemPlaces->removeElement($orderItemPlace);
    }

    /**
     * Get orderItemPlaces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderItemPlaces()
    {
        return $this->orderItemPlaces;
    }
}
