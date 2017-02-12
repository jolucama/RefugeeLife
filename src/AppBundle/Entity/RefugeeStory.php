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
     * @ORM\Column(type="string", length=255)
     */
    protected $protagonist;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $protagonistEmail;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $protagonistPhone;

    /**
     * @Assert\Country()
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $comingFromCountry;

    /**
     * @Assert\Country()
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $refugeeInCountry;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $latitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $longitude;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $isDeathStory = false;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $goal;
    
    /**
     * @var integer
     * @Assert\Range(min=0, max=100)
     * @ORM\Column(type="integer")
     */
    protected $achievedGoalPercentage = 0;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $isGoalAchieved = false;

    /**
     * Many Stories have many categories.
     *
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="refugeeStories")
     * @ORM\JoinTable(name="story_category")
     */
    protected $categories;

    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    protected $user;

    /**
     * @var Organization
     *
     * @ORM\OneToOne(targetEntity="Organization")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id", nullable=true)
     */
    protected $organization;

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getStory()
    {
        return $this->story;
    }

    /**
     * @param string $story
     */
    public function setStory($story)
    {
        $this->story = $story;
    }

    /**
     * @return string
     */
    public function getProtagonist()
    {
        return $this->protagonist;
    }

    /**
     * @param string $protagonist
     */
    public function setProtagonist($protagonist)
    {
        $this->protagonist = $protagonist;
    }

    /**
     * @return string
     */
    public function getProtagonistEmail()
    {
        return $this->protagonistEmail;
    }

    /**
     * @param string $protagonistEmail
     */
    public function setProtagonistEmail($protagonistEmail)
    {
        $this->protagonistEmail = $protagonistEmail;
    }

    /**
     * @return string
     */
    public function getProtagonistPhone()
    {
        return $this->protagonistPhone;
    }

    /**
     * @param string $protagonistPhone
     */
    public function setProtagonistPhone($protagonistPhone)
    {
        $this->protagonistPhone = $protagonistPhone;
    }

    /**
     * @return mixed
     */
    public function getComingFromCountry()
    {
        return $this->comingFromCountry;
    }

    /**
     * @param mixed $comingFromCountry
     */
    public function setComingFromCountry($comingFromCountry)
    {
        $this->comingFromCountry = $comingFromCountry;
    }

    /**
     * @return mixed
     */
    public function getRefugeeInCountry()
    {
        return $this->refugeeInCountry;
    }

    /**
     * @param mixed $refugeeInCountry
     */
    public function setRefugeeInCountry($refugeeInCountry)
    {
        $this->refugeeInCountry = $refugeeInCountry;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return boolean
     */
    public function isIsDeathStory()
    {
        return $this->isDeathStory;
    }

    /**
     * @param boolean $isDeathStory
     */
    public function setIsDeathStory($isDeathStory)
    {
        $this->isDeathStory = $isDeathStory;
    }

    /**
     * @return string
     */
    public function getGoal()
    {
        return $this->goal;
    }

    /**
     * @param string $goal
     */
    public function setGoal($goal)
    {
        $this->goal = $goal;
    }

    /**
     * @return int
     */
    public function getAchievedGoalPercentage()
    {
        return $this->achievedGoalPercentage;
    }

    /**
     * @param int $achievedGoalPercentage
     */
    public function setAchievedGoalPercentage($achievedGoalPercentage)
    {
        $this->achievedGoalPercentage = $achievedGoalPercentage;
    }

    /**
     * @return boolean
     */
    public function isIsGoalAchieved()
    {
        return $this->isGoalAchieved;
    }

    /**
     * @param boolean $isGoalAchieved
     */
    public function setIsGoalAchieved($isGoalAchieved)
    {
        $this->isGoalAchieved = $isGoalAchieved;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return Organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * @param Organization $organization
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
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
     * @return ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
    
    public function __sleep()
    {
        return [
            'id' => $this->id,
            'story' => $this->story,
            'protagonist' => $this->protagonist,
            'protagonistEmail' => $this->protagonistEmail,
            'protagonistPhone' => $this->protagonistPhone,
            'comingFromCountry' => $this->comingFromCountry,
            'refugeeInCountry' => $this->refugeeInCountry,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'deathStory' => $this->isDeathStory,
            'achievedGoalPercentage' => $this->achievedGoalPercentage,
            'achievedGoal' => $this->isGoalAchieved,
            //'tags' => $this->getCategories(),
            'user' => $this->user->__sleep(),
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt
        ];
    }
}
