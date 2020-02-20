<?php

namespace Ocd\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Ocd\NewsBundle\Entity\News;
use Ocd\NewsBundle\Model\NewsAttachmentTrait;
use Ocd\NewsBundle\Model\MultilangTrait;
use Ocd\UserBundle\Model\TimestampableInterface;
use Ocd\UserBundle\Model\TimestampableTrait;
use Ocd\UserBundle\Model\BlameableInterface;
use Ocd\UserBundle\Model\BlameableTrait;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Table(name="news_attachment")
 * @ORM\Entity(repositoryClass="Ocd\NewsBundle\Repository\NewsAttachmentRepository")
 * @Vich\Uploadable
 */
class NewsAttachment implements TimestampableInterface, BlameableInterface
{
    use NewsAttachmentTrait;
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
     * Many files have Many News.
     * @ORM\ManyToOne(targetEntity="News", inversedBy="attachments")
     * @ORM\JoinColumn(name="news_id", referencedColumnName="id", nullable=false)
     */
    protected $news;

    public function getId(): ?int
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
        return $this->name;
    }
}
