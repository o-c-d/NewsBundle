<?php

namespace Ocd\NewsBundle\Model;

use Doctrine\ORM\Mapping as ORM;


/**
 * Multilang Trait
 *
 */
trait MultilangTrait
{

    /**
     * @ORM\Column(name="lang", type="string", length=50)
     */
    protected $lang;

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

}