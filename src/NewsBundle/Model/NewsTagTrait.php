<?php

namespace Ocd\NewsBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsTag Trait
 *
 */
trait NewsTagTrait
{

    /**
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     */
    protected $name;

    public function getName(): string
    {
        if(null===$this->name)
        {
            return '';
        }
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}