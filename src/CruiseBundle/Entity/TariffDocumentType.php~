<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TariffDocumentType
 *
 * @ORM\Table(name="tariff_document_type")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\TariffDocumentTypeRepository")
 */
class TariffDocumentType
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
	 * @ORM\ManyToOne(targetEntity="Tariff")
	 */
	private $tariff;
	
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=20)
     */
    private $code;

    /**
     * @var bool
     *
     * @ORM\Column(name="need", type="boolean")
     */
    private $need;


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
     * Set code
     *
     * @param string $code
     *
     * @return TariffDocumentType
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
     * Set need
     *
     * @param boolean $need
     *
     * @return TariffDocumentType
     */
    public function setNeed($need)
    {
        $this->need = $need;

        return $this;
    }

    /**
     * Get need
     *
     * @return bool
     */
    public function getNeed()
    {
        return $this->need;
    }


    /**
     * Set tariff
     *
     * @param \CruiseBundle\Entity\Tariff $tariff
     *
     * @return TariffDocumentType
     */
    public function setTariff(\CruiseBundle\Entity\Tariff $tariff = null)
    {
        $this->tariff = $tariff;

        return $this;
    }

    /**
     * Get tariff
     *
     * @return \CruiseBundle\Entity\Tariff
     */
    public function getTariff()
    {
        return $this->tariff;
    }
}
