<?php

namespace Ocd\NewsBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Ocd\NewsBundle\Helper\StringSanitizer;

/**
 * News Trait
 *
 */
trait NewsTrait
{
    use MultilangTrait;
    use TimestampableTrait;
    use NewsTaggableTrait;
    
    /**
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\Column(name="slug", type="string", length=255)
     */
    protected $slug;

    /**
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    protected $content;

    /**
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    protected $publishedAt;

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of slug
     */ 
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @return  self
     */ 
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of publishedAt
     */ 
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set the value of publishedAt
     *
     * @return  self
     */ 
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Automatic Slug
     *
     * @ORM\PrePersist
     */
    public function autoSlug()
    {
        if(is_null($this->slug))
        {
            $this->setSlug(StringSanitizer::slugify($this->getTitle()));
        }
    }

}