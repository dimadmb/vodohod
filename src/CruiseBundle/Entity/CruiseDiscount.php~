<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CruiseDiscount
 *
 * @ORM\Table(name="cruise_discount")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\CruiseDiscountRepository")
 */
class CruiseDiscount
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
	 * @ORM\ManyToOne(targetEntity="Cruise", inversedBy="cruiseDiscount")
	 */
	private $cruise;

	/**
	 * @ORM\ManyToOne(targetEntity="Discount", fetch="EAGER"))
	 */
    private $discount;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="decimal", precision=10, scale=2)
     */
    private $value;




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
     * Set value
     *
     * @param string $value
     *
     * @return CruiseDiscount
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set cruise
     *
     * @param \CruiseBundle\Entity\Cruise $cruise
     *
     * @return CruiseDiscount
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
     * Set discount
     *
     * @param \CruiseBundle\Entity\Discount $discount
     *
     * @return CruiseDiscount
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
