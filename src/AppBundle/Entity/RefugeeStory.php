<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * RefugeeStory
 *
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="refugee_story")
 * @ORM\Entity
 */
class RefugeeStory
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    protected $coverImage;

    protected $mainImage;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $story;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=256)
     */
    protected $protagonist;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $protagonistEmail;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $protagonistPhone;

    /**
     * @Assert\Country()
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $comingFromCountry;

    /**
     * @Assert\Country()
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $refugeeInCountry;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $isDeathStory = false;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $goal;
    
    /**
     * @var integer
     * @Assert\Range(min=0, max=100)
     * @ORM\Column(type="integer")
     */
    protected $achievedGoalPercentage;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $isGoalAchieved = false;

    /**
     * @ORM\OneToOne(targetEntity="Organization")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     */
    protected $organization;

    /**
     * Many Stories have many categories.
     *
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="refugeeStories")
     * @ORM\JoinTable(name="story_category")
     */
    protected $categories;

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * RefugeeStory constructor.
     *
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * Add a new category to the collection
     *
     * @param Category $category
     */
    public function addCategory(Category $category)
    {
        $this->categories->add($category);
    }

    /**
     * Remove a category from the collection
     *
     * @param Category $category
     */
    public function removeCategory(Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }
}
