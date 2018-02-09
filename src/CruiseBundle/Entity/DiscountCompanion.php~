<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiscountCompanion
 *
 * @ORM\Table(name="discount_companion")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\DiscountCompanionRepository")
 */
class DiscountCompanion
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
	 * @ORM\ManyToOne(targetEntity="Companion")
	 */
	private $companion;
	
    /**
     * @var string
     *
     * @ORM\Column(name="code_1s", type="string", length=50)
     */
    private $code1s;

    /**
     * @var string
     *
     * @ORM\Column(name="promo_code", type="string", length=20)
     */
    private $promoCode;


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
     * Set code1s
     *
     * @param string $code1s
     *
     * @return DiscountCompanion
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

    /**
     * Set promoCode
     *
     * @param string $promoCode
     *
     * @return DiscountCompanion
     */
    public function setPromoCode($promoCode)
    {
        $this->promoCode = $promoCode;

        return $this;
    }

    /**
     * Get promoCode
     *
     * @return string
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }

    /**
     * Set discount
     *
     * @param \CruiseBundle\Entity\Discount $discount
     *
     * @return DiscountCompanion
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

    /**
     * Set companion
     *
     * @param \CruiseBundle\Entity\Companion $companion
     *
     * @return DiscountCompanion
     */
    public function setCompanion(\CruiseBundle\Entity\Companion $companion = null)
    {
        $this->companion = $companion;

        return $this;
    }

    /**
     * Get companion
     *
     * @return \CruiseBundle\Entity\Companion
     */
    public function getCompanion()
    {
        return $this->companion;
    }
}
