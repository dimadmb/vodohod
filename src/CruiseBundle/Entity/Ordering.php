<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ordering
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\OrderingRepository")
 * @ORM\HasLifecycleCallbacks 
 */
class Ordering
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
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_time", type="datetime", nullable=true)
     */
    private $deletedTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sended_time", type="datetime", nullable=true)
     */
    private $sendedTime;

    /**
     * @var bool
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=true)
     */
    private $deleted;

    /**
     * @var bool
     *
     * @ORM\Column(name="delete_request", type="boolean", nullable=true)
     */
    private $deleteRequest;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="delete_request_time", type="datetime", nullable=true)
     */
    private $deleteRequestTime;

    /**
     * @var bool
     *
     * @ORM\Column(name="sended", type="boolean", nullable=true)
     */
    private $sended;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="summ", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $summ;

    /**
     * @var string
     *
     * @ORM\Column(name="comission_summ", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $comissionSumm;

    /**
     * @var string
     *
     * @ORM\Column(name="comission_percent", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $comissionPercent;

    /**
     * @var string
     *
     * @ORM\Column(name="summ_discounts", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $summDiscounts;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="pay_hash", type="string", length=20, nullable=true)
     */
    private $payHash;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="order_1s_for_read", type="boolean", nullable=true)
     */
    private $order1sForRead;

    /**
     * @var bool
     *
     * @ORM\Column(name="order_1s_read", type="boolean", nullable=true)
     */
    private $order1sRead;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_1s_read_time", type="datetime", nullable=true)
     */
    private $order1sReadTime;

    /**
     * @var string
     *
     * @ORM\Column(name="order_1s_number", type="string", length=255, nullable=true)
     */
    private $order1sNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="order_1s_code", type="string", length=50, nullable=true)
     */
    private $order1sCode;

    /**
     * @var bool
     *
     * @ORM\Column(name="order_1s_confirmed", type="boolean", nullable=true)
     */
    private $order1sConfirmed;

    /**
     * @var bool
     *
     * @ORM\Column(name="order_1s_uploaded", type="boolean", nullable=true)
     */
    private $order1sUploaded;

    /**
     * @var string
     *
     * @ORM\Column(name="order_1s_manager", type="string", length=255, nullable=true)
     */
    private $order1sManager;

    /**
     * @var bool
     *
     * @ORM\Column(name="order_1s_validation", type="boolean", nullable=true)
     */
    private $order1sValidation;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_1s_id", type="string", length=20, nullable=true)
     */
    private $agency1sId;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_1s_code", type="string", length=50, nullable=true)
     */
    private $agency1sCode;


    /**
     * @var string
     *
     * @ORM\Column(name="manager_name", type="string", length=255, nullable=true)
     */
    private $managerName;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_buyer", type="text", nullable=true)
     */
    private $commentBuyer = "";

    /**
     * @var string
     *
     * @ORM\Column(name="comment_seller", type="text", nullable=true)
     */
    private $commentSeller = "";

    /**
     * @var string
     *
     * @ORM\Column(name="companion_1s_code", type="string", length=50, nullable=true)
     */
    private $companion1sCode;
	
    /**
     * @var string
     *
     * @ORM\Column(name="hash_code", type="string", length=32, nullable=true)
     */
    private $hashCode;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="OrderDeleteStatus")
	 */
	private $orderDeleteStatus;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Contractor")
	 */
	private $contractor;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Contract")
	 */
	private $contract;	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Manager")
	 */
	private $manager;
	
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="RoomStatus")
	 */
	private $roomStatus;	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Cruise")
	 */
	private $cruise;
	
	
	/**
	 * @ORM\OneToMany(targetEntity="OrderItem", mappedBy="order")
	 */
	private $orderItems;

	
	


	

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
     * Set deletedTime
     *
     * @param \DateTime $deletedTime
     *
     * @return Ordering
     */
    public function setDeletedTime($deletedTime)
    {
        $this->deletedTime = $deletedTime;

        return $this;
    }

    /**
     * Get deletedTime
     *
     * @return \DateTime
     */
    public function getDeletedTime()
    {
        return $this->deletedTime;
    }

    /**
     * Set sendedTime
     *
     * @param \DateTime $sendedTime
     *
     * @return Ordering
     */
    public function setSendedTime($sendedTime)
    {
        $this->sendedTime = $sendedTime;

        return $this;
    }

    /**
     * Get sendedTime
     *
     * @return \DateTime
     */
    public function getSendedTime()
    {
        return $this->sendedTime;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     *
     * @return Ordering
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return bool
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set deleteRequest
     *
     * @param boolean $deleteRequest
     *
     * @return Ordering
     */
    public function setDeleteRequest($deleteRequest)
    {
        $this->deleteRequest = $deleteRequest;

        return $this;
    }

    /**
     * Get deleteRequest
     *
     * @return bool
     */
    public function getDeleteRequest()
    {
        return $this->deleteRequest;
    }

    /**
     * Set deleteRequestTime
     *
     * @param \DateTime $deleteRequestTime
     *
     * @return Ordering
     */
    public function setDeleteRequestTime($deleteRequestTime)
    {
        $this->deleteRequestTime = $deleteRequestTime;

        return $this;
    }

    /**
     * Get deleteRequestTime
     *
     * @return \DateTime
     */
    public function getDeleteRequestTime()
    {
        return $this->deleteRequestTime;
    }

    /**
     * Set sended
     *
     * @param boolean $sended
     *
     * @return Ordering
     */
    public function setSended($sended)
    {
        $this->sended = $sended;

        return $this;
    }

    /**
     * Get sended
     *
     * @return bool
     */
    public function getSended()
    {
        return $this->sended;
    }

    /**
     * Set user
     *
     * @param integer $user
     *
     * @return Ordering
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set summ
     *
     * @param string $summ
     *
     * @return Ordering
     */
    public function setSumm($summ)
    {
        $this->summ = $summ;

        return $this;
    }

    /**
     * Get summ
     *
     * @return string
     */
    public function getSumm()
    {
        return $this->summ;
    }

    /**
     * Set comissionSumm
     *
     * @param string $comissionSumm
     *
     * @return Ordering
     */
    public function setComissionSumm($comissionSumm)
    {
        $this->comissionSumm = $comissionSumm;

        return $this;
    }

    /**
     * Get comissionSumm
     *
     * @return string
     */
    public function getComissionSumm()
    {
        return $this->comissionSumm;
    }

    /**
     * Set comissionPercent
     *
     * @param string $comissionPercent
     *
     * @return Ordering
     */
    public function setComissionPercent($comissionPercent)
    {
        $this->comissionPercent = $comissionPercent;

        return $this;
    }

    /**
     * Get comissionPercent
     *
     * @return string
     */
    public function getComissionPercent()
    {
        return $this->comissionPercent;
    }

    /**
     * Set summDiscounts
     *
     * @param string $summDiscounts
     *
     * @return Ordering
     */
    public function setSummDiscounts($summDiscounts)
    {
        $this->summDiscounts = $summDiscounts;

        return $this;
    }

    /**
     * Get summDiscounts
     *
     * @return string
     */
    public function getSummDiscounts()
    {
        return $this->summDiscounts;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Ordering
	 * @ORM\PrePersist()	
     */
    public function setCreated()
    {
        $this->created = new \DateTime;

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
     * Set payHash
     *
     * @param string $payHash
     *
     * @return Ordering
     */
    public function setPayHash($payHash)
    {
        $this->payHash = $payHash;

        return $this;
    }

    /**
     * Get payHash
     *
     * @return string
     */
    public function getPayHash()
    {
        return $this->payHash;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Ordering
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
     * Set email
     *
     * @param string $email
     *
     * @return Ordering
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set order1sForRead
     *
     * @param boolean $order1sForRead
     *
     * @return Ordering
     */
    public function setOrder1sForRead($order1sForRead)
    {
        $this->order1sForRead = $order1sForRead;

        return $this;
    }

    /**
     * Get order1sForRead
     *
     * @return bool
     */
    public function getOrder1sForRead()
    {
        return $this->order1sForRead;
    }

    /**
     * Set order1sRead
     *
     * @param boolean $order1sRead
     *
     * @return Ordering
     */
    public function setOrder1sRead($order1sRead)
    {
        $this->order1sRead = $order1sRead;

        return $this;
    }

    /**
     * Get order1sRead
     *
     * @return bool
     */
    public function getOrder1sRead()
    {
        return $this->order1sRead;
    }

    /**
     * Set order1sReadTime
     *
     * @param \DateTime $order1sReadTime
     *
     * @return Ordering
     */
    public function setOrder1sReadTime($order1sReadTime)
    {
        $this->order1sReadTime = $order1sReadTime;

        return $this;
    }

    /**
     * Get order1sReadTime
     *
     * @return \DateTime
     */
    public function getOrder1sReadTime()
    {
        return $this->order1sReadTime;
    }

    /**
     * Set order1sNumber
     *
     * @param string $order1sNumber
     *
     * @return Ordering
     */
    public function setOrder1sNumber($order1sNumber)
    {
        $this->order1sNumber = $order1sNumber;

        return $this;
    }

    /**
     * Get order1sNumber
     *
     * @return string
     */
    public function getOrder1sNumber()
    {
        return $this->order1sNumber;
    }

    /**
     * Set order1sCode
     *
     * @param string $order1sCode
     *
     * @return Ordering
     */
    public function setOrder1sCode($order1sCode)
    {
        $this->order1sCode = $order1sCode;

        return $this;
    }

    /**
     * Get order1sCode
     *
     * @return string
     */
    public function getOrder1sCode()
    {
        return $this->order1sCode;
    }

    /**
     * Set order1sConfirmed
     *
     * @param boolean $order1sConfirmed
     *
     * @return Ordering
     */
    public function setOrder1sConfirmed($order1sConfirmed)
    {
        $this->order1sConfirmed = $order1sConfirmed;

        return $this;
    }

    /**
     * Get order1sConfirmed
     *
     * @return bool
     */
    public function getOrder1sConfirmed()
    {
        return $this->order1sConfirmed;
    }

    /**
     * Set order1sUploaded
     *
     * @param boolean $order1sUploaded
     *
     * @return Ordering
     */
    public function setOrder1sUploaded($order1sUploaded)
    {
        $this->order1sUploaded = $order1sUploaded;

        return $this;
    }

    /**
     * Get order1sUploaded
     *
     * @return bool
     */
    public function getOrder1sUploaded()
    {
        return $this->order1sUploaded;
    }

    /**
     * Set order1sManager
     *
     * @param string $order1sManager
     *
     * @return Ordering
     */
    public function setOrder1sManager($order1sManager)
    {
        $this->order1sManager = $order1sManager;

        return $this;
    }

    /**
     * Get order1sManager
     *
     * @return string
     */
    public function getOrder1sManager()
    {
        return $this->order1sManager;
    }

    /**
     * Set order1sValidation
     *
     * @param boolean $order1sValidation
     *
     * @return Ordering
     */
    public function setOrder1sValidation($order1sValidation)
    {
        $this->order1sValidation = $order1sValidation;

        return $this;
    }

    /**
     * Get order1sValidation
     *
     * @return bool
     */
    public function getOrder1sValidation()
    {
        return $this->order1sValidation;
    }

    /**
     * Set agency1sId
     *
     * @param string $agency1sId
     *
     * @return Ordering
     */
    public function setAgency1sId($agency1sId)
    {
        $this->agency1sId = $agency1sId;

        return $this;
    }

    /**
     * Get agency1sId
     *
     * @return string
     */
    public function getAgency1sId()
    {
        return $this->agency1sId;
    }

    /**
     * Set agency1sCode
     *
     * @param string $agency1sCode
     *
     * @return Ordering
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
     * Set managerName
     *
     * @param string $managerName
     *
     * @return Ordering
     */
    public function setManagerName($managerName)
    {
        $this->managerName = $managerName;

        return $this;
    }

    /**
     * Get managerName
     *
     * @return string
     */
    public function getManagerName()
    {
        return $this->managerName;
    }

    /**
     * Set commentBuyer
     *
     * @param string $commentBuyer
     *
     * @return Ordering
     */
    public function setCommentBuyer($commentBuyer)
    {
        $this->commentBuyer = $commentBuyer;

        return $this;
    }

    /**
     * Get commentBuyer
     *
     * @return string
     */
    public function getCommentBuyer()
    {
        return $this->commentBuyer;
    }

    /**
     * Set commentSeller
     *
     * @param string $commentSeller
     *
     * @return Ordering
     */
    public function setCommentSeller($commentSeller)
    {
        $this->commentSeller = $commentSeller;

        return $this;
    }

    /**
     * Get commentSeller
     *
     * @return string
     */
    public function getCommentSeller()
    {
        return $this->commentSeller;
    }

    /**
     * Set companion1sCode
     *
     * @param string $companion1sCode
     *
     * @return Ordering
     */
    public function setCompanion1sCode($companion1sCode)
    {
        $this->companion1sCode = $companion1sCode;

        return $this;
    }

    /**
     * Get companion1sCode
     *
     * @return string
     */
    public function getCompanion1sCode()
    {
        return $this->companion1sCode;
    }

    /**
     * Set orderDeleteStatus
     *
     * @param \CruiseBundle\Entity\OrderDeleteStatus $orderDeleteStatus
     *
     * @return Ordering
     */
    public function setOrderDeleteStatus(\CruiseBundle\Entity\OrderDeleteStatus $orderDeleteStatus = null)
    {
        $this->orderDeleteStatus = $orderDeleteStatus;

        return $this;
    }

    /**
     * Get orderDeleteStatus
     *
     * @return \CruiseBundle\Entity\OrderDeleteStatus
     */
    public function getOrderDeleteStatus()
    {
        return $this->orderDeleteStatus;
    }

    /**
     * Set contractor
     *
     * @param \CruiseBundle\Entity\Contractor $contractor
     *
     * @return Ordering
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

    /**
     * Set contract
     *
     * @param \CruiseBundle\Entity\Contract $contract
     *
     * @return Ordering
     */
    public function setContract(\CruiseBundle\Entity\Contract $contract = null)
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * Get contract
     *
     * @return \CruiseBundle\Entity\Contract
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Set manager
     *
     * @param \CruiseBundle\Entity\Manager $manager
     *
     * @return Ordering
     */
    public function setManager(\CruiseBundle\Entity\Manager $manager = null)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * Get manager
     *
     * @return \CruiseBundle\Entity\Manager
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Set roomStatus
     *
     * @param \CruiseBundle\Entity\RoomStatus $roomStatus
     *
     * @return Ordering
     */
    public function setRoomStatus(\CruiseBundle\Entity\RoomStatus $roomStatus = null)
    {
        $this->roomStatus = $roomStatus;

        return $this;
    }

    /**
     * Get roomStatus
     *
     * @return \CruiseBundle\Entity\RoomStatus
     */
    public function getRoomStatus()
    {
        return $this->roomStatus;
    }

    /**
     * Set cruise
     *
     * @param \CruiseBundle\Entity\Cruise $cruise
     *
     * @return Ordering
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
     * Constructor
     */
    public function __construct()
    {
        $this->orderItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add orderItem
     *
     * @param \CruiseBundle\Entity\OrderItem $orderItem
     *
     * @return Ordering
     */
    public function addOrderItem(\CruiseBundle\Entity\OrderItem $orderItem)
    {
        $this->orderItems[] = $orderItem;

        return $this;
    }

    /**
     * Remove orderItem
     *
     * @param \CruiseBundle\Entity\OrderItem $orderItem
     */
    public function removeOrderItem(\CruiseBundle\Entity\OrderItem $orderItem)
    {
        $this->orderItems->removeElement($orderItem);
    }

    /**
     * Get orderItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * Set hashCode
     *
     * @param string $hashCode
     *
     * @return Ordering
	 * @ORM\PrePersist()		 
     */
    public function setHashCode()
    {
        $this->hashCode = md5(rand(1,99999).date("d-H-i-s"));

        return $this;
    }

    /**
     * Get hashCode
     *
     * @return string
     */
    public function getHashCode()
    {
        return $this->hashCode;
    }
}
