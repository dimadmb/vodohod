<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Deck
 *
 * @ORM\Table(name="deck")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\DeckRepository")
 */
class Deck
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
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var float
     *
     * @ORM\Column(name="priority", type="float")
     */
    private $priority;


	/**
	* @ORM\OneToMany(targetEntity="Room", mappedBy="deck")
	*/
	private $room;
	
	
	/**
	* @ORM\OneToMany(targetEntity="Price", mappedBy="deck")
	*/
	private $price;

	public function __construct()
	{
		$room = new ArrayCollection();
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
     * @return Deck
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
     * Set code
     *
     * @param string $code
     *
     * @return Deck
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set prority
     *
     * @param float $prority
     *
     * @return Deck
     */
    public function setPrority($prority)
    {
        $this->prority = $prority;

        return $this;
    }

    /**
     * Get prority
     *
     * @return float
     */
    public function getPrority()
    {
        return $this->prority;
    }

    /**
     * Add room
     *
     * @param \CruiseBundle\Entity\Room $room
     *
     * @return Deck
     */
    public function addRoom(\CruiseBundle\Entity\Room $room)
    {
        $this->room[] = $room;

        return $this;
    }

    /**
     * Remove room
     *
     * @param \CruiseBundle\Entity\Room $room
     */
    public function removeRoom(\CruiseBundle\Entity\Room $room)
    {
        $this->room->removeElement($room);
    }

    /**
     * Get room
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set priority
     *
     * @param float $priority
     *
     * @return Deck
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
     * Add price
     *
     * @param \CruiseBundle\Entity\Price $price
     *
     * @return Deck
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
