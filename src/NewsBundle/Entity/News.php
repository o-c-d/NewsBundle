<?php

namespace Ocd\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ocd\NewsBundle\Model\NewsTrait;
use Ocd\NewsBundle\Model\MultilangTrait;
use Ocd\NewsBundle\Model\TimestampableTrait;
use Ocd\NewsBundle\Model\NewsTaggableTrait;

/**
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="Ocd\NewsBundle\Repository\NewsRepository")
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
}
