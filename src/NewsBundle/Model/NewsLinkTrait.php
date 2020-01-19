<?php

namespace Ocd\NewsBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Ocd\NewsBundle\Entity\News;


/**
 * News Trait
 *
 */
trait NewsLinkTrait
{

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $text;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $uri;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $title;

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getUri(): string
    {
        if (null===$this->uri) {
            return '';
        }
        return $this->uri;
    }

    public function setUri(string $uri): self
    {
        $this->uri = $uri;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }
}