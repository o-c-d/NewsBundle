<?php

namespace Ocd\NewsBundle\Model;

use Doctrine\ORM\Mapping as ORM;


/**
 * News Trait
 *
 */
trait NewsTagTrait
{
    use MultilangTrait;
    use TimestampableTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * News articles
     * Many Tags have Many News.
     * @ORM\ManyToMany(targetEntity="News", mappedBy="tags")
     */
    protected $articles;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __tostring(): string
    {
        return $this->name;
    }

    public function addArticle(Article $article)
    {
        $this->articles[] = $article;
    }

    public function removeArticle(Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get news articles
     */ 
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set news articles
     *
     * @return  self
     */ 
    public function setArticles($articles)
    {
        $this->articles = $articles;

        return $this;
    }

}