<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Port
 *
 * @ORM\Table(name="port")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\PortRepository")
 */
class Port
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
     * @ORM\Column(name="name_akkuzativ", type="string", length=255)
     */
    private $nameAkkuzativ;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;
	
	
	/**
	 * @ORM\OneToMany(targetEntity="Excursion", mappedBy="port")
	 */
	private $excursion;
	
	/**
	 * @ORM\OneToMany(targetEntity="CruiseDays", mappedBy="port")
	 */
	private $cruiseDays;	
	
	public function __construct()
	{
		$excursion = new ArrayCollection();
		$cruiseDays = new ArrayCollection();
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
     * @return Port
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
     * Set nameAkkuzativ
     *
     * @param string $nameAkkuzativ
     *
     * @return Port
     */
    public function setNameAkkuzativ($nameAkkuzativ)
    {
        $this->nameAkkuzativ = $nameAkkuzativ;

        return $this;
    }

    /**
     * Get nameAkkuzativ
     *
     * @return string
     */
    public function getNameAkkuzativ()
    {
        return $this->nameAkkuzativ;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Port
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
     * Add excursion
     *
     * @param \CruiseBundle\Entity\Excursion $excursion
     *
     * @return Port
     */
    public function addExcursion(\CruiseBundle\Entity\Excursion $excursion)
    {
        $this->excursion[] = $excursion;

        return $this;
    }

    /**
     * Remove excursion
     *
     * @param \CruiseBundle\Entity\Excursion $excursion
     */
    public function removeExcursion(\CruiseBundle\Entity\Excursion $excursion)
    {
        $this->excursion->removeElement($excursion);
    }

    /**
     * Get excursion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExcursion()
    {
        return $this->excursion;
    }

    /**
     * Add cruiseDay
     *
     * @param \CruiseBundle\Entity\CruiseDays $cruiseDay
     *
     * @return Port
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
