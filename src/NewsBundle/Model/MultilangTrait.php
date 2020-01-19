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
     * @ORM\Column(name="lang", type="string", length=50, nullable=false, options={"default"="fr"})
     */
    protected $lang;

    public function getLang(): ?string
    {
        // if(null===$this->lang)
        // {
        //     return 'fr';
        // }
        return $this->lang;
    }

    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

}