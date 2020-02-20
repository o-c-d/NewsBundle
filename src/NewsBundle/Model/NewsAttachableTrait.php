<?php

namespace Ocd\NewsBundle\Model;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ocd\NewsBundle\Entity\NewsAttachment;

/**
 * NewsLinkable Trait
 *
 */
trait NewsAttachableTrait
{

    /**
     * News attachments
     * Many News have Many Attachments.
     * @ORM\OneToMany(targetEntity="NewsAttachment", mappedBy="news", cascade={"all"}, orphanRemoval=true)
     */
    private $attachments;
    
    public function addAttachment(NewsAttachment $attachment):self
    {
        $attachment->setNews($this); // synchronously updating inverse side
        $this->attachments[] = $attachment;
        return $this;
    }

    public function removeAttachment(NewsAttachment $attachment):self
    {
        $this->attachments->removeElement($attachment);
        $attachment->setNews(null); // synchronously updating inverse side
        return $this;
    }

    /**
     * Get News attachments.
     */ 
    public function getAttachments():Collection
    {
        return $this->attachments;
    }

    /**
     * Set News attachments.
     *
     * @return  self
     */ 
    public function setAttachments(Collection $attachments):self
    {
        $this->attachments = $attachments;

        return $this;
    }

}