<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CruiseCategory
 *
 * @ORM\Table(name="cruise_category")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\CruiseCategoryRepository")
 */
class CruiseCategory
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
	 * @ORM\ManyToMany(targetEntity="Cruise", mappedBy="category" )
	 */
	private $cruise;
    
	public function __construct()
	{
		$cruise = new ArrayCollection();
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
     * Add cruise
     *
     * @param \CruiseBundle\Entity\Cruise $cruise
     *
     * @return CruiseCategory
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
}
