<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contractor
 *
 * @ORM\Table(name="contractor")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\ContractorRepository")
 */
class Contractor
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="nameShort", type="string", length=255)
     */
    private $nameShort;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="inn", type="string", length=255)
     */
    private $inn;

    /**
     * @var string
     *
     * @ORM\Column(name="okpo", type="string", length=255)
     */
    private $okpo;

    /**
     * @var string
     *
     * @ORM\Column(name="kpp", type="string", length=255)
     */
    private $kpp;

    /**
     * @var string
     *
     * @ORM\Column(name="bik", type="string", length=255)
     */
    private $bik;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="bank", type="string", length=255)
     */
    private $bank;

    /**
     * @var string
     *
     * @ORM\Column(name="account_number", type="string", length=255)
     */
    private $accountNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="account_number_corr", type="string", length=255)
     */
    private $accountNumberCorr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create", type="datetime")
     */
    private $create;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update", type="datetime")
     */
    private $update;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="address_post", type="string", length=255)
     */
    private $addressPost;

    /**
     * @var string
     *
     * @ORM\Column(name="address_factual", type="string", length=255)
     */
    private $addressFactual;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="tax_light", type="string", length=5)
     */
    private $taxLight;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="agency_1s_read_time", type="datetime")
     */
    private $agency1sReadTime;

    /**
     * @var bool
     *
     * @ORM\Column(name="agency_1s_read", type="boolean")
     */
    private $agency1sRead;

    /**
     * @var bool
     *
     * @ORM\Column(name="agency_1s_uploaded", type="boolean")
     */
    private $agency1sUploaded;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_1s_id", type="string", length=20)
     */
    private $agency1sId;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_1s_code", type="string", length=50)
     */
    private $agency1sCode;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_header_document", type="string", length=255)
     */
    private $agencyHeaderDocument;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_header_state_genitive", type="string", length=255)
     */
    private $agencyHeaderStateGenitive;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_header_fio_genitive", type="string", length=255)
     */
    private $agencyHeaderFioGenitive;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_header_state", type="string", length=255)
     */
    private $agencyHeaderState;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_header_fio", type="string", length=255)
     */
    private $agencyHeaderFio;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_add_type", type="string", length=20)
     */
    private $agencyAddType;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_added_type", type="string", length=20)
     */
    private $agencyAddedType;

    /**
     * @var string
     *
     * @ORM\Column(name="contract_default_1s_code", type="string", length=50)
     */
    private $contractDefault1sCode;

	
	/**
	 *
	 */
	private $contract;


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
     * Set name
     *
     * @param string $name
     *
     * @return Agency
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
     * Set type
     *
     * @param string $type
     *
     * @return Agency
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set nameShort
     *
     * @param string $nameShort
     *
     * @return Agency
     */
    public function setNameShort($nameShort)
    {
        $this->nameShort = $nameShort;

        return $this;
    }

    /**
     * Get nameShort
     *
     * @return string
     */
    public function getNameShort()
    {
        return $this->nameShort;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Agency
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Agency
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Agency
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set inn
     *
     * @param string $inn
     *
     * @return Agency
     */
    public function setInn($inn)
    {
        $this->inn = $inn;

        return $this;
    }

    /**
     * Get inn
     *
     * @return string
     */
    public function getInn()
    {
        return $this->inn;
    }

    /**
     * Set okpo
     *
     * @param string $okpo
     *
     * @return Agency
     */
    public function setOkpo($okpo)
    {
        $this->okpo = $okpo;

        return $this;
    }

    /**
     * Get okpo
     *
     * @return string
     */
    public function getOkpo()
    {
        return $this->okpo;
    }

    /**
     * Set kpp
     *
     * @param string $kpp
     *
     * @return Agency
     */
    public function setKpp($kpp)
    {
        $this->kpp = $kpp;

        return $this;
    }

    /**
     * Get kpp
     *
     * @return string
     */
    public function getKpp()
    {
        return $this->kpp;
    }

    /**
     * Set bik
     *
     * @param string $bik
     *
     * @return Agency
     */
    public function setBik($bik)
    {
        $this->bik = $bik;

        return $this;
    }

    /**
     * Get bik
     *
     * @return string
     */
    public function getBik()
    {
        return $this->bik;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Agency
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
     * Set bank
     *
     * @param string $bank
     *
     * @return Agency
     */
    public function setBank($bank)
    {
        $this->bank = $bank;

        return $this;
    }

    /**
     * Get bank
     *
     * @return string
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * Set accountNumber
     *
     * @param string $accountNumber
     *
     * @return Agency
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * Get accountNumber
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * Set accountNumberCorr
     *
     * @param string $accountNumberCorr
     *
     * @return Agency
     */
    public function setAccountNumberCorr($accountNumberCorr)
    {
        $this->accountNumberCorr = $accountNumberCorr;

        return $this;
    }

    /**
     * Get accountNumberCorr
     *
     * @return string
     */
    public function getAccountNumberCorr()
    {
        return $this->accountNumberCorr;
    }

    /**
     * Set create
     *
     * @param \DateTime $create
     *
     * @return Agency
     */
    public function setCreate($create)
    {
        $this->create = $create;

        return $this;
    }

    /**
     * Get create
     *
     * @return \DateTime
     */
    public function getCreate()
    {
        return $this->create;
    }

    /**
     * Set update
     *
     * @param \DateTime $update
     *
     * @return Agency
     */
    public function setUpdate($update)
    {
        $this->update = $update;

        return $this;
    }

    /**
     * Get update
     *
     * @return \DateTime
     */
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Agency
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set addressPost
     *
     * @param string $addressPost
     *
     * @return Agency
     */
    public function setAddressPost($addressPost)
    {
        $this->addressPost = $addressPost;

        return $this;
    }

    /**
     * Get addressPost
     *
     * @return string
     */
    public function getAddressPost()
    {
        return $this->addressPost;
    }

    /**
     * Set addressFactual
     *
     * @param string $addressFactual
     *
     * @return Agency
     */
    public function setAddressFactual($addressFactual)
    {
        $this->addressFactual = $addressFactual;

        return $this;
    }

    /**
     * Get addressFactual
     *
     * @return string
     */
    public function getAddressFactual()
    {
        return $this->addressFactual;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Agency
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
     * Set taxLight
     *
     * @param string $taxLight
     *
     * @return Agency
     */
    public function setTaxLight($taxLight)
    {
        $this->taxLight = $taxLight;

        return $this;
    }

    /**
     * Get taxLight
     *
     * @return string
     */
    public function getTaxLight()
    {
        return $this->taxLight;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Agency
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set agency1sReadTime
     *
     * @param \DateTime $agency1sReadTime
     *
     * @return Agency
     */
    public function setAgency1sReadTime($agency1sReadTime)
    {
        $this->agency1sReadTime = $agency1sReadTime;

        return $this;
    }

    /**
     * Get agency1sReadTime
     *
     * @return \DateTime
     */
    public function getAgency1sReadTime()
    {
        return $this->agency1sReadTime;
    }

    /**
     * Set agency1sRead
     *
     * @param boolean $agency1sRead
     *
     * @return Agency
     */
    public function setAgency1sRead($agency1sRead)
    {
        $this->agency1sRead = $agency1sRead;

        return $this;
    }

    /**
     * Get agency1sRead
     *
     * @return boolean
     */
    public function getAgency1sRead()
    {
        return $this->agency1sRead;
    }

    /**
     * Set agency1sUploaded
     *
     * @param boolean $agency1sUploaded
     *
     * @return Agency
     */
    public function setAgency1sUploaded($agency1sUploaded)
    {
        $this->agency1sUploaded = $agency1sUploaded;

        return $this;
    }

    /**
     * Get agency1sUploaded
     *
     * @return boolean
     */
    public function getAgency1sUploaded()
    {
        return $this->agency1sUploaded;
    }

    /**
     * Set agency1sId
     *
     * @param string $agency1sId
     *
     * @return Agency
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
     * @return Agency
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
     * Set agencyHeaderDocument
     *
     * @param string $agencyHeaderDocument
     *
     * @return Agency
     */
    public function setAgencyHeaderDocument($agencyHeaderDocument)
    {
        $this->agencyHeaderDocument = $agencyHeaderDocument;

        return $this;
    }

    /**
     * Get agencyHeaderDocument
     *
     * @return string
     */
    public function getAgencyHeaderDocument()
    {
        return $this->agencyHeaderDocument;
    }

    /**
     * Set agencyHeaderStateGenitive
     *
     * @param string $agencyHeaderStateGenitive
     *
     * @return Agency
     */
    public function setAgencyHeaderStateGenitive($agencyHeaderStateGenitive)
    {
        $this->agencyHeaderStateGenitive = $agencyHeaderStateGenitive;

        return $this;
    }

    /**
     * Get agencyHeaderStateGenitive
     *
     * @return string
     */
    public function getAgencyHeaderStateGenitive()
    {
        return $this->agencyHeaderStateGenitive;
    }

    /**
     * Set agencyHeaderFioGenitive
     *
     * @param string $agencyHeaderFioGenitive
     *
     * @return Agency
     */
    public function setAgencyHeaderFioGenitive($agencyHeaderFioGenitive)
    {
        $this->agencyHeaderFioGenitive = $agencyHeaderFioGenitive;

        return $this;
    }

    /**
     * Get agencyHeaderFioGenitive
     *
     * @return string
     */
    public function getAgencyHeaderFioGenitive()
    {
        return $this->agencyHeaderFioGenitive;
    }

    /**
     * Set agencyHeaderState
     *
     * @param string $agencyHeaderState
     *
     * @return Agency
     */
    public function setAgencyHeaderState($agencyHeaderState)
    {
        $this->agencyHeaderState = $agencyHeaderState;

        return $this;
    }

    /**
     * Get agencyHeaderState
     *
     * @return string
     */
    public function getAgencyHeaderState()
    {
        return $this->agencyHeaderState;
    }

    /**
     * Set agencyHeaderFio
     *
     * @param string $agencyHeaderFio
     *
     * @return Agency
     */
    public function setAgencyHeaderFio($agencyHeaderFio)
    {
        $this->agencyHeaderFio = $agencyHeaderFio;

        return $this;
    }

    /**
     * Get agencyHeaderFio
     *
     * @return string
     */
    public function getAgencyHeaderFio()
    {
        return $this->agencyHeaderFio;
    }

    /**
     * Set agencyAddType
     *
     * @param string $agencyAddType
     *
     * @return Agency
     */
    public function setAgencyAddType($agencyAddType)
    {
        $this->agencyAddType = $agencyAddType;

        return $this;
    }

    /**
     * Get agencyAddType
     *
     * @return string
     */
    public function getAgencyAddType()
    {
        return $this->agencyAddType;
    }

    /**
     * Set agencyAddedType
     *
     * @param string $agencyAddedType
     *
     * @return Agency
     */
    public function setAgencyAddedType($agencyAddedType)
    {
        $this->agencyAddedType = $agencyAddedType;

        return $this;
    }

    /**
     * Get agencyAddedType
     *
     * @return string
     */
    public function getAgencyAddedType()
    {
        return $this->agencyAddedType;
    }

    /**
     * Set ac1sCode
     *
     * @param string $ac1sCode
     *
     * @return Agency
     */
    public function setAc1sCode($ac1sCode)
    {
        $this->ac1sCode = $ac1sCode;

        return $this;
    }

    /**
     * Get ac1sCode
     *
     * @return string
     */
    public function getAc1sCode()
    {
        return $this->ac1sCode;
    }

    /**
     * Set contractDefault1sCode
     *
     * @param string $contractDefault1sCode
     *
     * @return Contractor
     */
    public function setContractDefault1sCode($contractDefault1sCode)
    {
        $this->contractDefault1sCode = $contractDefault1sCode;

        return $this;
    }

    /**
     * Get contractDefault1sCode
     *
     * @return string
     */
    public function getContractDefault1sCode()
    {
        return $this->contractDefault1sCode;
    }
}
