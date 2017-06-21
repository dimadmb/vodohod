<?php

namespace ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ForumTheme
 *
 * @ORM\Table(name="forum_theme")
 * @ORM\Entity(repositoryClass="ForumBundle\Repository\ForumThemeRepository")
 */
class ForumTheme
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
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;

    /**
     * @var bool
     *
     * @ORM\Column(name="closed", type="boolean")
     */
    private $closed;

    /**
     * @var string
     *
     * @ORM\Column(name="subscriber", type="text", nullable=true)
     */
    private $subscriber;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Forum", inversedBy="forumTheme")
	 */
	private $forum;

		
	/**
	 * @ORM\ManyToOne(targetEntity="BaseBundle\Entity\User")
	 */
	private $user;
	
	
	/**
	 * @ORM\OneToMany(targetEntity="ForumMessage", mappedBy="forumTheme")
	 */
	private $forumMessages;

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
     * @return ForumTheme
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
     * @return ForumTheme
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
     * @return ForumTheme
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
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return ForumTheme
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set closed
     *
     * @param boolean $closed
     *
     * @return ForumTheme
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * Get closed
     *
     * @return bool
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Set subscriber
     *
     * @param string $subscriber
     *
     * @return ForumTheme
     */
    public function setSubscriber($subscriber)
    {
        $this->subscriber = $subscriber;

        return $this;
    }

    /**
     * Get subscriber
     *
     * @return string
     */
    public function getSubscriber()
    {
        return $this->subscriber;
    }

    /**
     * Set forum
     *
     * @param \ForumBundle\Entity\Forum $forum
     *
     * @return ForumTheme
     */
    public function setForum(\ForumBundle\Entity\Forum $forum = null)
    {
        $this->forum = $forum;

        return $this;
    }

    /**
     * Get forum
     *
     * @return \ForumBundle\Entity\Forum
     */
    public function getForum()
    {
        return $this->forum;
    }

    /**
     * Set user
     *
     * @param \BaseBundle\Entity\User $user
     *
     * @return ForumTheme
     */
    public function setUser(\BaseBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BaseBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->forumMessages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add forumMessage
     *
     * @param \ForumBundle\Entity\ForumMessage $forumMessage
     *
     * @return ForumTheme
     */
    public function addForumMessage(\ForumBundle\Entity\ForumMessage $forumMessage)
    {
        $this->forumMessages[] = $forumMessage;

        return $this;
    }

    /**
     * Remove forumMessage
     *
     * @param \ForumBundle\Entity\ForumMessage $forumMessage
     */
    public function removeForumMessage(\ForumBundle\Entity\ForumMessage $forumMessage)
    {
        $this->forumMessages->removeElement($forumMessage);
    }

    /**
     * Get forumMessages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getForumMessages()
    {
        return $this->forumMessages;
    }
}
