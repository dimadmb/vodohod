<?php

namespace ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Forum
 *
 * @ORM\Table(name="forum")
 * @ORM\Entity(repositoryClass="ForumBundle\Repository\ForumRepository")
 */
class Forum
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
     * @var int
     *
     * @ORM\Column(name="sort", type="integer", nullable=true)
     */
    private $sort;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="ForumGroup", inversedBy="forum")
	 * @ORM\OrderBy({"sort" = "ASC"})	 
	 */
	private $forumGroup;
	
	/**
	 * @ORM\OneToMany(targetEntity="ForumTheme", mappedBy="forum")
	 */
	private $forumTheme;

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
     * @return Forum
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
     * @return Forum
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
     * Set sort
     *
     * @param integer $sort
     *
     * @return Forum
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
     * Set active
     *
     * @param boolean $active
     *
     * @return Forum
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
     * Set forumGroup
     *
     * @param \ForumBundle\Entity\ForumGroup $forumGroup
     *
     * @return Forum
     */
    public function setForumGroup(\ForumBundle\Entity\ForumGroup $forumGroup = null)
    {
        $this->forumGroup = $forumGroup;

        return $this;
    }

    /**
     * Get forumGroup
     *
     * @return \ForumBundle\Entity\ForumGroup
     */
    public function getForumGroup()
    {
        return $this->forumGroup;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->forumTheme = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add forumTheme
     *
     * @param \ForumBundle\Entity\ForumTheme $forumTheme
     *
     * @return Forum
     */
    public function addForumTheme(\ForumBundle\Entity\ForumTheme $forumTheme)
    {
        $this->forumTheme[] = $forumTheme;

        return $this;
    }

    /**
     * Remove forumTheme
     *
     * @param \ForumBundle\Entity\ForumTheme $forumTheme
     */
    public function removeForumTheme(\ForumBundle\Entity\ForumTheme $forumTheme)
    {
        $this->forumTheme->removeElement($forumTheme);
    }

    /**
     * Get forumTheme
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getForumTheme()
    {
        return $this->forumTheme;
    }
}
