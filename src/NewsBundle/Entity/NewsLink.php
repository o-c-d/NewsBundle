<?php

namespace Ocd\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Ocd\NewsBundle\Entity\News;
use Ocd\NewsBundle\Model\NewsLinkTrait;
use Ocd\NewsBundle\Model\MultilangTrait;
use Ocd\UserBundle\Model\TimestampableInterface;
use Ocd\UserBundle\Model\TimestampableTrait;
use Ocd\UserBundle\Model\BlameableInterface;
use Ocd\UserBundle\Model\BlameableTrait;

/**
 * @ORM\Table(name="news_link")
 * @ORM\Entity(repositoryClass="Ocd\NewsBundle\Repository\NewsLinkRepository")
 */
class NewsLink implements TimestampableInterface, BlameableInterface
{
    use NewsLinkTrait;
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
     * @ORM\ManyToOne(targetEntity="News", inversedBy="links")
     * @ORM\JoinColumn(name="news_id", referencedColumnName="id")
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
    public function getNews():ArrayCollection
    {
        return $this->news;
    }

    /**
     * Set news
     *
     * @return  self
     */ 
    public function setNews(ArrayCollection $news)
    {
        $this->news = $news;

        return $this;
    }


    public function __tostring(): string
    {
        return $this->uri;
    }
}
