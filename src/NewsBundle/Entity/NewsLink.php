<?php

namespace Ocd\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\JoinColumn(name="news_id", referencedColumnName="id", nullable=false)
     */
    protected $news;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get news
     */ 
    public function getNews():News
    {
        return $this->news;
    }

    /**
     * Set news
     *
     * @return  self
     */ 
    public function setNews(News $news)
    {
        $this->news = $news;

        return $this;
    }


    public function __tostring(): string
    {
        return $this->uri;
    }
}
