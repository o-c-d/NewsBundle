<?php

namespace Ocd\NewsBundle\Model;

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
        $attachment->addNews($this); // synchronously updating inverse side
        $this->attachments[] = $attachment;
        return $this;
    }

    public function removeAttachment(NewsAttachment $attachment):self
    {
        $this->attachments->removeElement($attachment);
        $attachment->removeNews($this); // synchronously updating inverse side
        return $this;
    }

    /**
     * Get News attachments.
     */ 
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Set News attachments.
     *
     * @return  self
     */ 
    public function setAttachments($attachments):self
    {
        $this->attachments = $attachments;

        return $this;
    }

}