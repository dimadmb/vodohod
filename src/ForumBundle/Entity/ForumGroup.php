<?php

namespace ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ForumGroup
 *
 * @ORM\Table(name="forum_group")
 * @ORM\Entity(repositoryClass="ForumBundle\Repository\ForumGroupRepository")
 */
class ForumGroup
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
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var int
     *
     * @ORM\Column(name="sort", type="integer", nullable=true)
     */
    private $sort;
	
	/**
	 * @ORM\OneToMany(targetEntity="Forum", mappedBy="forumGroup",   fetch="EAGER" )
	 * @ORM\OrderBy({"sort" = "ASC"})

	 */
	private $forum;


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
     * @return ForumGroup
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
     * Set comment
     *
     * @param string $comment
     *
     * @return ForumGroup
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return ForumGroup
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set sort
     *
     * @param integer $sort
     *
     * @return ForumGroup
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->forum = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add forum
     *
     * @param \ForumBundle\Entity\Forum $forum
     *
     * @return ForumGroup
     */
    public function addForum(\ForumBundle\Entity\Forum $forum)
    {
        $this->forum[] = $forum;

        return $this;
    }

    /**
     * Remove forum
     *
     * @param \ForumBundle\Entity\Forum $forum
     */
    public function removeForum(\ForumBundle\Entity\Forum $forum)
    {
        $this->forum->removeElement($forum);
    }

    /**
     * Get forum
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getForum()
    {
        return $this->forum;
    }
}
