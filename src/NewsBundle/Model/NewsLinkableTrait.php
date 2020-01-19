<?php

namespace Ocd\NewsBundle\Model;

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
     * @ORM\ManyToMany(targetEntity="NewsLink", inversedBy="news", cascade={"persist"})
     * @ORM\JoinTable(name="news__links")
     */
    private $links;
    
    public function addLink(NewsLink $link)
    {
        $link->addNews($this); // synchronously updating inverse side
        $this->links[] = $link;
        return $this;
    }

    public function removeLink(NewsLink $link)
    {
        $this->links->removeElement($link);
        $link->removeNews($this); // synchronously updating inverse side
        return $this;
    }

    /**
     * Get News links.
     */ 
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set News links.
     *
     * @return  self
     */ 
    public function setLinks($links) 
    {
        $this->links = $links;

        return $this;
    }

}