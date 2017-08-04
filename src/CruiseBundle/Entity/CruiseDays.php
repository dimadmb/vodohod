<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CruiseDays
 *
 * @ORM\Table(name="cruise_days")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\CruiseDaysRepository")
 */
class CruiseDays
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
     * @ORM\ManyToOne(targetEntity="Excursion", inversedBy="cruiseDays")
     */
    private $excursion;

    /**
     * @ORM\ManyToOne(targetEntity="Cruise", inversedBy="cruiseDays")
     */
    private $cruise;

    /**
     * @ORM\ManyToOne(targetEntity="Port", inversedBy="cruiseDays")
     */
    private $port;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeStart", type="time")
     */
    private $timeStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeStop", type="time")
     */
    private $timeStop;

    /**
     * @var int
     *
     * @ORM\Column(name="day", type="integer")
     */
    private $day;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;


    /**
     * @var string
     *
     * @ORM\Column(name="code_1s", type="string", length=50, nullable=true)
     */
    private $code1s;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set timeStart
     *
     * @param \DateTime $timeStart
     *
     * @return CruiseDays
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;

        return $this;
    }

    /**
     * Get timeStart
     *
     * @return \DateTime
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }

    /**
     * Set timeStop
     *
     * @param \DateTime $timeStop
     *
     * @return CruiseDays
     */
    public function setTimeStop($timeStop)
    {
        $this->timeStop = $timeStop;

        return $this;
    }

    /**
     * Get timeStop
     *
     * @return \DateTime
     */
    public function getTimeStop()
    {
        return $this->timeStop;
    }

    /**
     * Set day
     *
     * @param integer $day
     *
     * @return CruiseDays
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return integer
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return CruiseDays
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
     * Set excursion
     *
     * @param \CruiseBundle\Entity\Excursion $excursion
     *
     * @return CruiseDays
     */
    public function setExcursion(\CruiseBundle\Entity\Excursion $excursion = null)
    {
        $this->excursion = $excursion;

        return $this;
    }

    /**
     * Get excursion
     *
     * @return \CruiseBundle\Entity\Excursion
     */
    public function getExcursion()
    {
        return $this->excursion;
    }

    /**
     * Set cruise
     *
     * @param \CruiseBundle\Entity\Cruise $cruise
     *
     * @return CruiseDays
     */
    public function setCruise(\CruiseBundle\Entity\Cruise $cruise = null)
    {
        $this->cruise = $cruise;

        return $this;
    }

    /**
     * Get cruise
     *
     * @return \CruiseBundle\Entity\Cruise
     */
    public function getCruise()
    {
        return $this->cruise;
    }

    /**
     * Set port
     *
     * @param \CruiseBundle\Entity\Port $port
     *
     * @return CruiseDays
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
     * Set code1s
     *
     * @param string $code1s
     *
     * @return CruiseDays
     */
    public function setCode1s($code1s)
    {
        $this->code1s = $code1s;

        return $this;
    }

    /**
     * Get code1s
     *
     * @return string
     */
    public function getCode1s()
    {
        return $this->code1s;
    }
}
