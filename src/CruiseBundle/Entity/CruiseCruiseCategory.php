<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CruiseCruiseCategory
 *
 * @ORM\Table(name="cruise_cruise_category")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\CruiseCruiseCategoryRepository")
 */
class CruiseCruiseCategory
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
     * @ORM\Column(name="cruise_category_code", type="string", length=255)
     */
    private $cruiseCategoryCode;

	
	/**
	 * @ORM\ManyToOne(targetEntity="Cruise")
	 */
	private $cruise;
	
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
     * Set cruiseCategoryCode
     *
     * @param string $cruiseCategoryCode
     *
     * @return CruiseCruiseCategory
     */
    public function setCruiseCategoryCode($cruiseCategoryCode)
    {
        $this->cruiseCategoryCode = $cruiseCategoryCode;

        return $this;
    }

    /**
     * Get cruiseCategoryCode
     *
     * @return string
     */
    public function getCruiseCategoryCode()
    {
        return $this->cruiseCategoryCode;
    }
}

