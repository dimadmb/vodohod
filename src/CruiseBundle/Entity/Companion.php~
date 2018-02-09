<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Companion
 *
 * @ORM\Table(name="companion")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\CompanionRepository")
 */
class Companion
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
     * @ORM\Column(name="companion_1s_code", type="string", length=50)
     */
    private $companion1sCode;


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
     * Set name
     *
     * @param string $name
     *
     * @return Companion
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
     * Set companion1sCode
     *
     * @param string $companion1sCode
     *
     * @return Companion
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
}
