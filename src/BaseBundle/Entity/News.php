<?php

namespace BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="BaseBundle\Repository\NewsRepository")
 */
class News extends Page
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
     * @ORM\Column(name="announce", type="text", nullable=true)
     */
    private $announce;


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
     * Set announce
     *
     * @param string $announce
     *
     * @return News
     */
    public function setAnnounce($announce)
    {
        $this->announce = $announce;

        return $this;
    }

    /**
     * Get announce
     *
     * @return string
     */
    public function getAnnounce()
    {
        return $this->announce;
    }
}

