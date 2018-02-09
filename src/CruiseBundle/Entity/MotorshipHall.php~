<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MotorshipHall
 *
 * @ORM\Table(name="motorship_hall")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\MotorshipHallRepository")
 */
class MotorshipHall
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
     * @ORM\ManyToOne(targetEntity="Motorship", inversedBy="hall")
     */
    private $motorship;

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
     * @return MotorshipHall
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
     * @return MotorshipHall
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
     * Set motorship
     *
     * @param \CruiseBundle\Entity\Motorship $motorship
     *
     * @return MotorshipHall
     */
    public function setMotorship(\CruiseBundle\Entity\Motorship $motorship = null)
    {
        $this->motorship = $motorship;

        return $this;
    }

    /**
     * Get motorship
     *
     * @return \CruiseBundle\Entity\Motorship
     */
    public function getMotorship()
    {
        return $this->motorship;
    }
}
