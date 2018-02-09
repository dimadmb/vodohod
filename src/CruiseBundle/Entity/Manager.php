<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Manager
 *
 * @ORM\Table(name="manager")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\ManagerRepository")
 */
class Manager
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
     * @var bool
     *
     * @ORM\Column(name="is_admin", type="boolean")
     */
    private $isAdmin;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var bool
     *
     * @ORM\Column(name="confirmed", type="boolean")
     */
    private $confirmed;

    /**
     * @var string
     *
     * @ORM\Column(name="hash_confirm", type="string", length=50)
     */
    private $hashConfirm;

    /**
     * @var int
     *
     * @ORM\Column(name="active", type="integer")
     */
    private $active;

    /**
     * @var int
     *
     * @ORM\Column(name="active_others", type="integer")
     */
    private $activeOthers;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var bool
     *
     * @ORM\Column(name="show_all_orders", type="boolean")
     */
    private $showAllOrders;

    /**
     * @var bool
     *
     * @ORM\Column(name="write_all_orders", type="boolean")
     */
    private $writeAllOrders;

    /**
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=50)
     */
    private $hash;


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
     * Set isAdmin
     *
     * @param boolean $isAdmin
     *
     * @return AgencyManager
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Get isAdmin
     *
     * @return bool
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return AgencyManager
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return AgencyManager
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
     * Set confirmed
     *
     * @param boolean $confirmed
     *
     * @return AgencyManager
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    /**
     * Get confirmed
     *
     * @return bool
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * Set hashConfirm
     *
     * @param string $hashConfirm
     *
     * @return AgencyManager
     */
    public function setHashConfirm($hashConfirm)
    {
        $this->hashConfirm = $hashConfirm;

        return $this;
    }

    /**
     * Get hashConfirm
     *
     * @return string
     */
    public function getHashConfirm()
    {
        return $this->hashConfirm;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return AgencyManager
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return int
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set activeOthers
     *
     * @param integer $activeOthers
     *
     * @return AgencyManager
     */
    public function setActiveOthers($activeOthers)
    {
        $this->activeOthers = $activeOthers;

        return $this;
    }

    /**
     * Get activeOthers
     *
     * @return int
     */
    public function getActiveOthers()
    {
        return $this->activeOthers;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return AgencyManager
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set showAllOrders
     *
     * @param boolean $showAllOrders
     *
     * @return AgencyManager
     */
    public function setShowAllOrders($showAllOrders)
    {
        $this->showAllOrders = $showAllOrders;

        return $this;
    }

    /**
     * Get showAllOrders
     *
     * @return bool
     */
    public function getShowAllOrders()
    {
        return $this->showAllOrders;
    }

    /**
     * Set writeAllOrders
     *
     * @param boolean $writeAllOrders
     *
     * @return AgencyManager
     */
    public function setWriteAllOrders($writeAllOrders)
    {
        $this->writeAllOrders = $writeAllOrders;

        return $this;
    }

    /**
     * Get writeAllOrders
     *
     * @return bool
     */
    public function getWriteAllOrders()
    {
        return $this->writeAllOrders;
    }

    /**
     * Set hash
     *
     * @param string $hash
     *
     * @return AgencyManager
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }
}
