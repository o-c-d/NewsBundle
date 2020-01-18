<?php

namespace Ocd\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ocd\NewsBundle\Model\NewsTrait;
use Ocd\NewsBundle\Model\MultilangTrait;
use Ocd\NewsBundle\Model\TimestampableTrait;
use Ocd\NewsBundle\Model\NewsTaggableTrait;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Table(name="news")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Ocd\NewsBundle\Repository\NewsRepository")
 * @Vich\Uploadable
 */
class News
{
    const NUM_ITEMS = 10 ;
    use NewsTrait;
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->title;
    }

}
