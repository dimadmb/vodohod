<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * MotorshipType
 *
 * @ORM\Table(name="motorship_type")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\MotorshipTypeRepository")
 */
class MotorshipType
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
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;
	
	
	/**
	 * @ORM\OneToMany(targetEntity="Motorship", mappedBy="motorshipType")
	 */
	private $motorship;
	
	public function __construct()
	{
		$this->motorship = new ArrayCollection();
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
     * @return MotorshipType
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
     * @return MotorshipType
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
     * Set priority
     *
     * @param float $priority
     *
     * @return MotorshipType
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
     * Set comment
     *
     * @param string $comment
     *
     * @return MotorshipType
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Add motorship
     *
     * @param \CruiseBundle\Entity\Motorship $motorship
     *
     * @return MotorshipType
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
}
