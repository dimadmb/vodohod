<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiscountExclusion
 *
 * @ORM\Table(name="discount_exclusion",uniqueConstraints={@ORM\UniqueConstraint(name="discount_exclusion_idx", columns={"discount_id", "discount_exclusion_id"})})
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\DiscountExclusionRepository")
 */
class DiscountExclusion
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
	* @ORM\ManyToOne(targetEntity="Discount", inversedBy="exclusions")
	*/
    private $discount; 		
	
	/**
	* @ORM\ManyToOne(targetEntity="Discount")
	*/
    private $discountExclusion; 	
	
	


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
     * Set discount
     *
     * @param \CruiseBundle\Entity\Discount $discount
     *
     * @return DiscountExclusion
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
     * Set discountExclusion
     *
     * @param \CruiseBundle\Entity\Discount $discountExclusion
     *
     * @return DiscountExclusion
     */
    public function setDiscountExclusion(\CruiseBundle\Entity\Discount $discountExclusion = null)
    {
        $this->discountExclusion = $discountExclusion;

        return $this;
    }

    /**
     * Get discountExclusion
     *
     * @return \CruiseBundle\Entity\Discount
     */
    public function getDiscountExclusion()
    {
        return $this->discountExclusion;
    }
}
