<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * MotorshipClass
 *
 * @ORM\Table(name="motorship_class")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\MotorshipClassRepository")
 */
class MotorshipClass
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
     * @var float
     *
     * @ORM\Column(name="priority", type="float")
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

	
	/**
	 * @ORM\OneToMany(targetEntity="Motorship", mappedBy="motorshipClass")
	 */
	private $motorship;
	
	public function __construct()
	{
		$this->motorship = new ArrayCollection();
	}

	public function __toString()
	{
		return $this->name;
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
     * @return MotorshipClass
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
     * Set priority
     *
     * @param float $priority
     *
     * @return MotorshipClass
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
     * Set code
     *
     * @param string $code
     *
     * @return MotorshipClass
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
     * Add motorship
     *
     * @param \CruiseBundle\Entity\Motorship $motorship
     *
     * @return MotorshipClass
     */
    public function addMotorship(\CruiseBundle\Entity\Motorship $motorship)
    {
        $this->motorship[] = $motorship;

        return $this;
    }

    /**
     * Remove motorship
     *
     * @param \CruiseBundle\Entity\Motorship $motorship
     */
    public function removeMotorship(\CruiseBundle\Entity\Motorship $motorship)
    {
        $this->motorship->removeElement($motorship);
    }

    /**
     * Get motorship
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMotorship()
    {
        return $this->motorship;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return MotorshipClass
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
}
