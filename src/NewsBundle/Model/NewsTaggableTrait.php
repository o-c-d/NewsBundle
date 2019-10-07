<?php

namespace Ocd\NewsBundle\Model;

use Doctrine\ORM\Mapping as ORM;


/**
 * News Trait
 *
 */
trait NewsTaggableTrait
{

    /**
     * News tags
     * Many News have Many Tags.
     * @ORM\ManyToMany(targetEntity="NewsTag", inversedBy="articles")
     * @ORM\JoinTable(name="news_tags")
     */
    private $tags;
    
    public function addTag(Tag $tag)
    {
        $tag->addArticle($this); // synchronously updating inverse side
        $this->tags[] = $tag;
    }

    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
        $tag->removeArticle($this); // synchronously updating inverse side
    }

    /**
     * Get News tags.
     */ 
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set News tags.
     *
     * @return  self
     */ 
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

}