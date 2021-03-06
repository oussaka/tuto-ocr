<?php

namespace ChrisScientistPlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection ;
use Gedmo\Mapping\Annotation as Gedmo ;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 * Advert
 *
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="ChrisScientistPlatformBundle\Repository\AdvertRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Advert
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @Assert\DateTime()
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\Length(min=10)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     * @Assert\Length(min=2)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     */
    private $content;
    
    /**
     *
     * @var type boolean
     * 
     * @ORM\Column(name="published", type="boolean")
     */
    private $published ;
    
    /**
     *
     * @var type \DateTime
     * 
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt ;
    
    /**
     *
     * @var type int
     * 
     * @ORM\Column(name="nb_applications", type="integer")
     */
    private $nbApplications ;
    
    /**
     *
     * @var type ChrisScientistPlatformBundle\Entity\Image
     * 
     * @ORM\OneToOne(targetEntity="ChrisScientistPlatformBundle\Entity\Image", 
     *              cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $image ;
    
    /**
     *
     * @var type ChrisScientistPlatformBundle\Entity\Application
     * 
     * @ORM\OneToMany(targetEntity="ChrisScientistPlatformBundle\Entity\Application", 
     *               mappedBy="advert")
     */
    private $applications ;
    
    /**
     *
     * @var type ChrisScientistPlatformBundle\Entity\Category
     * 
     * @ORM\ManyToMany(targetEntity="ChrisScientistPlatformBundle\Entity\Category", 
     *              cascade={"persist"})
     */
    private $categories ;
    
    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slugTitle ;

    public function __construct()
    {
        $this->published = true ;
        $this->date = new \DateTime() ;
        $this->categories = new ArrayCollection() ;
        $this->applications = new ArrayCollection() ;
        $this->nbApplications = 0 ;
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
     * Set date
     *
     * @param \DateTime $date
     * @return Advert
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Advert
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
     * Set author
     *
     * @param string $author
     * @return Advert
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Advert
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Advert
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Advert
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function updateDate()
    {
        $this->setUpdatedAt(new \DateTime()) ;
    }

    /**
     * Set nbApplications
     *
     * @param integer $nbApplications
     * @return Advert
     */
    public function setNbApplications($nbApplications)
    {
        $this->nbApplications = $nbApplications;

        return $this;
    }

    /**
     * Get nbApplications
     *
     * @return integer 
     */
    public function getNbApplications()
    {
        return $this->nbApplications;
    }
    
    public function increaseApplication()
    {
        $this->nbApplications++ ;
    }
    
    public function decreaseApplication()
    {
        $this->nbApplications-- ;
    }

    /**
     * Set image
     *
     * @param \ChrisScientistPlatformBundle\Entity\Image $image
     * @return Advert
     */
    public function setImage(\ChrisScientistPlatformBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \ChrisScientistPlatformBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add applications
     *
     * @param \ChrisScientistPlatformBundle\Entity\Application $applications
     * @return Advert
     */
    public function addApplication(\ChrisScientistPlatformBundle\Entity\Application $applications)
    {
        $this->applications[] = $applications;

        return $this;
    }

    /**
     * Remove applications
     *
     * @param \ChrisScientistPlatformBundle\Entity\Application $applications
     */
    public function removeApplication(\ChrisScientistPlatformBundle\Entity\Application $applications)
    {
        $this->applications->removeElement($applications);
    }

    /**
     * Get applications
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getApplications()
    {
        return $this->applications;
    }

    /**
     * Add categories
     *
     * @param \ChrisScientistPlatformBundle\Entity\Category $categories
     * @return Advert
     */
    public function addCategory(\ChrisScientistPlatformBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \ChrisScientistPlatformBundle\Entity\Category $categories
     */
    public function removeCategory(\ChrisScientistPlatformBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set slugTitle
     *
     * @param string $slugTitle
     * @return Advert
     */
    public function setSlugTitle($slugTitle)
    {
        $this->slugTitle = $slugTitle;

        return $this;
    }

    /**
     * Get slugTitle
     *
     * @return string 
     */
    public function getSlugTitle()
    {
        return $this->slugTitle;
    }
}
