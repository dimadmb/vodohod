<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Excursion
 *
 * @ORM\Table(name="excursion")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\ExcursionRepository")
 */
class Excursion
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Port", inversedBy="excursion")
     */
    private $port;
	
	/**
	 * @ORM\OneToMany(targetEntity="CruiseDays", mappedBy="excursion")
	 */
	private $cruiseDays;
	
	public function __construct()
	{
		$this->cruiseDay = new ArrayCollection();
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
     * @return Excursion
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
     * Set description
     *
     * @param string $description
     *
     * @return Excursion
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }



    /**
     * Set port
     *
     * @param \CruiseBundle\Entity\Port $port
     *
     * @return Excursion
     */
    public function setPort(\CruiseBundle\Entity\Port $port = null)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return \CruiseBundle\Entity\Port
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Add cruiseDay
     *
     * @param \CruiseBundle\Entity\CruiseDays $cruiseDay
     *
     * @return Excursion
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
}
