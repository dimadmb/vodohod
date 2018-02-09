<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contract
 *
 * @ORM\Table(name="contract")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\ContractRepository")
 */
class Contract
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=50)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contractor_1s_code", type="string", length=50)
     */
    private $contractor1sCode;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="main", type="boolean")
     */
    private $main;

    /**
     * @var string
     *
     * @ORM\Column(name="percentpercent", type="decimal", precision=10, scale=2)
     */
    private $percentpercent;

    /**
     * @var int
     *
     * @ORM\Column(name="comission_type", type="integer")
     */
    private $comissionType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="date")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_stop", type="date")
     */
    private $dateStop;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ac_1c_time_updated", type="datetime")
     */
    private $ac1cTimeUpdated;

    /**
     * @var bool
     *
     * @ORM\Column(name="ac_1s_read", type="boolean")
     */
    private $ac1sRead;
	
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Contractor")
	 */
	private $contractor;




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
     * Set agency1sCode
     *
     * @param string $agency1sCode
     *
     * @return AgencyContract
     */
    public function setAgency1sCode($agency1sCode)
    {
        $this->agency1sCode = $agency1sCode;

        return $this;
    }

    /**
     * Get agency1sCode
     *
     * @return string
     */
    public function getAgency1sCode()
    {
        return $this->agency1sCode;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return AgencyContract
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return AgencyContract
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
     * Set main
     *
     * @param boolean $main
     *
     * @return AgencyContract
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main
     *
     * @return bool
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * Set percentpercent
     *
     * @param string $percentpercent
     *
     * @return AgencyContract
     */
    public function setPercentpercent($percentpercent)
    {
        $this->percentpercent = $percentpercent;

        return $this;
    }

    /**
     * Get percentpercent
     *
     * @return string
     */
    public function getPercentpercent()
    {
        return $this->percentpercent;
    }

    /**
     * Set comissionType
     *
     * @param integer $comissionType
     *
     * @return AgencyContract
     */
    public function setComissionType($comissionType)
    {
        $this->comissionType = $comissionType;

        return $this;
    }

    /**
     * Get comissionType
     *
     * @return int
     */
    public function getComissionType()
    {
        return $this->comissionType;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return AgencyContract
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return AgencyContract
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateStop
     *
     * @param \DateTime $dateStop
     *
     * @return AgencyContract
     */
    public function setDateStop($dateStop)
    {
        $this->dateStop = $dateStop;

        return $this;
    }

    /**
     * Get dateStop
     *
     * @return \DateTime
     */
    public function getDateStop()
    {
        return $this->dateStop;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return AgencyContract
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return AgencyContract
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set ac1cTimeUpdated
     *
     * @param \DateTime $ac1cTimeUpdated
     *
     * @return AgencyContract
     */
    public function setAc1cTimeUpdated($ac1cTimeUpdated)
    {
        $this->ac1cTimeUpdated = $ac1cTimeUpdated;

        return $this;
    }

    /**
     * Get ac1cTimeUpdated
     *
     * @return \DateTime
     */
    public function getAc1cTimeUpdated()
    {
        return $this->ac1cTimeUpdated;
    }

    /**
     * Set ac1sRead
     *
     * @param boolean $ac1sRead
     *
     * @return AgencyContract
     */
    public function setAc1sRead($ac1sRead)
    {
        $this->ac1sRead = $ac1sRead;

        return $this;
    }

    /**
     * Get ac1sRead
     *
     * @return bool
     */
    public function getAc1sRead()
    {
        return $this->ac1sRead;
    }


    /**
     * Set contractor1sCode
     *
     * @param string $contractor1sCode
     *
     * @return Contract
     */
    public function setContractor1sCode($contractor1sCode)
    {
        $this->contractor1sCode = $contractor1sCode;

        return $this;
    }

    /**
     * Get contractor1sCode
     *
     * @return string
     */
    public function getContractor1sCode()
    {
        return $this->contractor1sCode;
    }

    /**
     * Set id
     *
     * @param string $id
     *
     * @return Contract
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set contractor
     *
     * @param \CruiseBundle\Entity\Contractor $contractor
     *
     * @return Contract
     */
    public function setContractor(\CruiseBundle\Entity\Contractor $contractor = null)
    {
        $this->contractor = $contractor;

        return $this;
    }

    /**
     * Get contractor
     *
     * @return \CruiseBundle\Entity\Contractor
     */
    public function getContractor()
    {
        return $this->contractor;
    }
}
