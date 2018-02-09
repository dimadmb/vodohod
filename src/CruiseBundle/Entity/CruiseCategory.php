<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CruiseCategory
 *
 * @ORM\Table(name="cruise_category", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\CruiseCategoryRepository")
 */
class CruiseCategory
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=255)
     * @ORM\Id

     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
	
	/**
	 * @ORM\ManyToMany(targetEntity="Cruise", inversedBy="category")
	 */	
    private $cruises;
	
	

	

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
     * @return CruiseCategory
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
     * @return CruiseCategory
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
     * Constructor
     */
    public function __construct()
    {
        $this->cruises = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cruise
     *
     * @param \CruiseBundle\Entity\Cruise $cruise
     *
     * @return CruiseCategory
     */
    public function addCruise(\CruiseBundle\Entity\Cruise $cruise)
    {
        $this->cruises[] = $cruise;

        return $this;
    }

    /**
     * Remove cruise
     *
     * @param \CruiseBundle\Entity\Cruise $cruise
     */
    public function removeCruise(\CruiseBundle\Entity\Cruise $cruise)
    {
        $this->cruises->removeElement($cruise);
    }

    /**
     * Get cruises
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCruises()
    {
        return $this->cruises;
    }

    /**
     * Set id
     *
     * @param string $id
     *
     * @return CruiseCategory
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
