<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CruiseClass
 *
 * @ORM\Table(name="cruise_class")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\CruiseClassRepository")
 */
class CruiseClass
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
     * @ORM\Column(name="body", type="text")
     */
    private $body;
	
	
	/**
	 * @ORM\OneToMany(targetEntity="Cruise" , mappedBy="cruiseClass") 
	*/
	private $cruise;
	
	public function __construct()
	{
		$this->cruise = new ArrayCollection();
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
     * @return CruiseClass
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
     * Set body
     *
     * @param string $body
     *
     * @return CruiseClass
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Add cruise
     *
     * @param \CruiseBundle\Entity\Cruise $cruise
     *
     * @return CruiseClass
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
