<?php

namespace Ocd\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Ocd\NewsBundle\Entity\News;
use Ocd\NewsBundle\Model\NewsTagTrait;
use Ocd\NewsBundle\Model\MultilangTrait;
use Ocd\UserBundle\Model\TimestampableInterface;
use Ocd\UserBundle\Model\TimestampableTrait;
use Ocd\UserBundle\Model\BlameableInterface;
use Ocd\UserBundle\Model\BlameableTrait;

/**
 * @ORM\Table(name="news_tag")
 * @ORM\Entity(repositoryClass="Ocd\NewsBundle\Repository\NewsTagRepository")
 */
class NewsTag implements TimestampableInterface, BlameableInterface
{
    use NewsTagTrait;
    use MultilangTrait;
    use TimestampableTrait;
    use BlameableTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * News 
     * Many Tags have Many News.
     * @ORM\ManyToMany(targetEntity="News", mappedBy="tags")
     */
    protected $news;

    public function getId(): int
    {
        return $this->id;
    }

    public function addNews(News $news)
    {
        $this->news[] = $news;
    }

    public function removeNews(News $news)
    {
        $this->news->removeElement($news);
    }

    /**
     * Get news
     */ 
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set news
     *
     * @return  self
     */ 
    public function setNews($news)
    {
        $this->news = $news;

        return $this;
    }



    public function __tostring(): string
    {
        return $this->name;
    }
}
