<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiscountDocumentType
 *
 * @ORM\Table(name="discount_document_type")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\DiscountDocumentTypeRepository")
 */
class DiscountDocumentType
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
	 * @ORM\ManyToOne(targetEntity="Discount")
	 */
	private $discount;
	

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
     * @return DiscountDocumentType
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
     * @return DiscountDocumentType
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
     * Set discount
     *
     * @param \CruiseBundle\Entity\Discount $discount
     *
     * @return DiscountDocumentType
     */
    public function setDiscount(\CruiseBundle\Entity\Discount $discount = null)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return \CruiseBundle\Entity\Discount
     */
    public function getDiscount()
    {
        return $this->discount;
    }
}
