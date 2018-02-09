<?php

namespace BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="BaseBundle\Repository\PageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Page
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
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="children")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Page", mappedBy="parent")
     */
    private $children;	
	
	
	/**
	 * @ORM\ManyToMany(targetEntity="Image")
	 * @ORM\OrderBy({"sort" = "ASC"})
	 * @ORM\JoinTable(name="page_image", joinColumns={@ORM\JoinColumn(name="page_id",
		referencedColumnName="id", onDelete="CASCADE")},
	 * inverseJoinColumns={@ORM\JoinColumn(name="image_id",
	referencedColumnName="id", onDelete="CASCADE")})
	 */	
    private $file;
	  


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="full_url", type="string", length=255, unique=true)
     */
    private $fullUrl;
    /**
     * @var string
     *
     * @ORM\Column(name="parent_url", type="string", length=255)
     */
    private $parentUrl;
    /**
     * @var string
     *
     * @ORM\Column(name="local_url", type="string", length=255)
     */
    private $localUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="h1", type="string", length=255)
     */
    private $h1;




    /**
     * @ORM\Column(type="string")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */

    private $bannerImg;

    /**
     * @var string
     *
     * @ORM\Column(name="banner_html", type="text", nullable=true)
     */
    private $bannerHtml;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var int
     *
     * @ORM\Column(name="sort", type="integer")
     */
    private $sort;


    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_menu", type="boolean")
     */
    private $isMenu;
	
	
    /**
     * @var bool
     *
     * @ORM\Column(name="is_folder", type="boolean")
     */
    private $isFolder;
	
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
		$this->file = new \Doctrine\Common\Collections\ArrayCollection(); 
    }	
	
	
    public function disableChildrenLazyLoading()
    {
        if (is_object($this->children)) {
            $this->children->setInitialized(true);
        }
    }	
	
	
	public function __toString()
	{
		return $this->name;
	}
	
	

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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Page
	 
	 * @ORM\PrePersist	 
     */
    public function setCreated($created)
    {
        $this->created = new \DateTime('now');

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Page
	 * @ORM\PreUpdate	 
     */
    public function setUpdated($updated)
    {
        $this->updated = new \DateTime('now');

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Page
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
     * Set fullUrl
     *
     * @param string $fullUrl
     *
     * @return Page
     */
    public function setFullUrl($fullUrl)
    {
        $this->fullUrl = $fullUrl;

        return $this;
    }

    /**
     * Get fullUrl
     *
     * @return string
     */
    public function getFullUrl()
    {
        return $this->fullUrl;
    }

    /**
     * Set parentUrl
     *
     * @param string $parentUrl
     *
     * @return Page
     */
    public function setParentUrl($parentUrl)
    {
        $this->parentUrl = $parentUrl;

        return $this;
    }

    /**
     * Get parentUrl
     *
     * @return string
     */
    public function getParentUrl()
    {
        return $this->parentUrl;
    }

    /**
     * Set localUrl
     *
     * @param string $localUrl
     *
     * @return Page
     */
    public function setLocalUrl($localUrl)
    {
        $this->localUrl = $localUrl;

        return $this;
    }

    /**
     * Get localUrl
     *
     * @return string
     */
    public function getLocalUrl()
    {
        return $this->localUrl;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Page
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set h1
     *
     * @param string $h1
     *
     * @return Page
     */
    public function setH1($h1)
    {
        $this->h1 = $h1;

        return $this;
    }

    /**
     * Get h1
     *
     * @return string
     */
    public function getH1()
    {
        return $this->h1;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Page
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
     * Set sort
     *
     * @param integer $sort
     *
     * @return Page
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return integer
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
     * @return Page
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set isMenu
     *
     * @param boolean $isMenu
     *
     * @return Page
     */
    public function setIsMenu($isMenu)
    {
        $this->isMenu = $isMenu;

        return $this;
    }

    /**
     * Get isMenu
     *
     * @return boolean
     */
    public function getIsMenu()
    {
        return $this->isMenu;
    }

    /**
     * Set isFolder
     *
     * @param boolean $isFolder
     *
     * @return Page
     */
    public function setIsFolder($isFolder)
    {
        $this->isFolder = $isFolder;

        return $this;
    }

    /**
     * Get isFolder
     *
     * @return boolean
     */
    public function getIsFolder()
    {
        return $this->isFolder;
    }

    /**
     * Set parent
     *
     * @param \BaseBundle\Entity\Page $parentId
     *
     * @return Page
     */
    public function setParent(\BaseBundle\Entity\Page $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \BaseBundle\Entity\Page
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add child
     *
     * @param \BaseBundle\Entity\Page $child
     *
     * @return Page
     */
    public function addChild(\BaseBundle\Entity\Page $child)
    {
        $this->children[] = $child;
		$child->setParent($this);

        return $this;
    }

    /**
     * Remove child
     *
     * @param \BaseBundle\Entity\Page $child
     */
    public function removeChild(\BaseBundle\Entity\Page $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add file
     *
     * @param \BaseBundle\Entity\Image $file
     *
     * @return Page
     */
    public function addFile(\BaseBundle\Entity\Image $file)
    {
        $this->file[] = $file;
		
        return $this;
    }

    /**
     * Remove file
     *
     * @param \BaseBundle\Entity\Image $file
     */
    public function removeFile(\BaseBundle\Entity\Image $file)
    {
        $this->file->removeElement($file);
    }
    /**
     * Remove file
     *
     * @param \BaseBundle\Entity\Image $file
     */
    public function removeAllFile()
    {
        $this->file = [];
    }

    /**
     * Get file
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFile()
    {
        return $this->file;
    }



    /**
     * Set bannerHtml
     *
     * @param string $bannerHtml
     *
     * @return Page
     */
    public function setBannerHtml($bannerHtml)
    {
        $this->bannerHtml = $bannerHtml;

        return $this;
    }

    /**
     * Get bannerHtml
     *
     * @return string
     */
    public function getBannerHtml()
    {
        return $this->bannerHtml;
    }

    /**
     * Set bannerImg
     *
     * @param string $bannerImg
     *
     * @return Page
     */
    public function setBannerImg($bannerImg)
    {
        $this->bannerImg = $bannerImg;

        return $this;
    }

    /**
     * Get bannerImg
     *
     * @return string
     */
    public function getBannerImg()
    {
        return $this->bannerImg;
    }
}
