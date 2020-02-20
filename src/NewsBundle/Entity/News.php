<?php

namespace Ocd\NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ocd\NewsBundle\Model\NewsTrait;
use Ocd\NewsBundle\Model\MultilangTrait;
use Ocd\NewsBundle\Model\NewsTaggableTrait;
use Ocd\NewsBundle\Model\NewsLinkableTrait;
use Ocd\NewsBundle\Model\NewsAttachableTrait;
use Ocd\UserBundle\Model\TimestampableInterface;
use Ocd\UserBundle\Model\TimestampableTrait;
use Ocd\UserBundle\Model\BlameableInterface;
use Ocd\UserBundle\Model\BlameableTrait;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Table(name="news")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Ocd\NewsBundle\Repository\NewsRepository")
 * @Vich\Uploadable
 */
class News implements TimestampableInterface, BlameableInterface
{
    const NUM_ITEMS = 10 ;
    use NewsTrait;
    use MultilangTrait;
    use TimestampableTrait;
    use NewsTaggableTrait;
    use NewsLinkableTrait;
    use NewsAttachableTrait;
    use BlameableTrait;
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function __construct() {
        $this->tags = new ArrayCollection();
        $this->links = new ArrayCollection();
        $this->attachments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->title;
    }

}
