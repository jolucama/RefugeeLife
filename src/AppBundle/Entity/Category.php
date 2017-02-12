<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=256, nullable=false, unique=true)
     */
    protected $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="RefugeeStory", mappedBy="categories")
     */
    protected $refugeeStories;
    
    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->refugeeStories = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection
     */
    public function getRefugeeStories()
    {
        return $this->refugeeStories;
    }

    /**
     * @param ArrayCollection $refugeeStories
     */
    public function setRefugeeStories($refugeeStories)
    {
        $this->refugeeStories = $refugeeStories;
    }

    public function __toString()
    {
        return $this->name;
    }
}
