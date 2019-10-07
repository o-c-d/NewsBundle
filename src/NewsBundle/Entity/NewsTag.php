<?php

namespace Ocd\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ocd\NewsBundle\Model\NewsTagTrait;

/**
 * @ORM\Table(name="news_tag")
 * @ORM\Entity(repositoryClass="Ocd\NewsBundle\Repository\NewsTagRepository")
 */
class NewsTag
{
    use NewsTagTrait;
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
