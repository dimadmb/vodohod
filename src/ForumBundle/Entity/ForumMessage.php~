<?php

namespace ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ForumMessage
 *
 * @ORM\Table(name="forum_message")
 * @ORM\Entity(repositoryClass="ForumBundle\Repository\ForumMessageRepository")
 */
class ForumMessage
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
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="quote", type="text", nullable=true)
     */
    private $quote;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;

    /**
     * @var bool
     *
     * @ORM\Column(name="moderation", type="boolean")
     */
    private $moderation;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var int
     *
     * @ORM\Column(name="replayId", type="integer", nullable=true)
     */
    private $replayId;

    /**
     * @var bool
     *
     * @ORM\Column(name="block", type="boolean")
     */
    private $block;
	
	/**
	 * @ORM\ManyToOne(targetEntity="ForumTheme", inversedBy="forumMessages")
	 */
	private $forumTheme;
	
	/**
	 * @ORM\ManyToOne(targetEntity="BaseBundle\Entity\User")
	 */
	private $user;


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
     * Set body
     *
     * @param string $body
     *
     * @return ForumMessage
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set quote
     *
     * @param string $quote
     *
     * @return ForumMessage
     */
    public function setQuote($quote)
    {
        $this->quote = $quote;

        return $this;
    }

    /**
     * Get quote
     *
     * @return string
     */
    public function getQuote()
    {
        return $this->quote;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return ForumMessage
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
     * Set moderation
     *
     * @param boolean $moderation
     *
     * @return ForumMessage
     */
    public function setModeration($moderation)
    {
        $this->moderation = $moderation;

        return $this;
    }

    /**
     * Get moderation
     *
     * @return bool
     */
    public function getModeration()
    {
        return $this->moderation;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return ForumMessage
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
     * Set replayId
     *
     * @param integer $replayId
     *
     * @return ForumMessage
     */
    public function setReplayId($replayId)
    {
        $this->replayId = $replayId;

        return $this;
    }

    /**
     * Get replayId
     *
     * @return int
     */
    public function getReplayId()
    {
        return $this->replayId;
    }

    /**
     * Set block
     *
     * @param boolean $block
     *
     * @return ForumMessage
     */
    public function setBlock($block)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return bool
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * Set forumTheme
     *
     * @param \ForumBundle\Entity\ForumTheme $forumTheme
     *
     * @return ForumMessage
     */
    public function setForumTheme(\ForumBundle\Entity\ForumTheme $forumTheme = null)
    {
        $this->forumTheme = $forumTheme;

        return $this;
    }

    /**
     * Get forumTheme
     *
     * @return \ForumBundle\Entity\ForumTheme
     */
    public function getForumTheme()
    {
        return $this->forumTheme;
    }

    /**
     * Set user
     *
     * @param \BaseBundle\Entity\User $user
     *
     * @return ForumMessage
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
}
