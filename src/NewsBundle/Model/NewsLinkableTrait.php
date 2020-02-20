<?php

namespace Ocd\NewsBundle\Model;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ocd\NewsBundle\Entity\NewsLink;

/**
 * NewsLinkable Trait
 *
 */
trait NewsLinkableTrait
{

    /**
     * News links
     * Many News have Many Links.
     * @ORM\OneToMany(targetEntity="NewsLink", mappedBy="news", cascade={"all"}, orphanRemoval=true)
     */
    private $links;
    
    public function addLink(NewsLink $link)
    {
        $link->setNews($this); // synchronously updating inverse side
        $this->links[] = $link;
        return $this;
    }

    public function removeLink(NewsLink $link)
    {
        $this->links->removeElement($link);
        $link->setNews(null); // synchronously updating inverse side
        return $this;
    }

    /**
     * Get News links.
     */ 
    public function getLinks():Collection
    {
        return $this->links;
    }

    /**
     * Set News links.
     *
     * @return  self
     */ 
    public function setLinks(Collection $links) :self
    {
        $this->links = $links;

        return $this;
    }

}