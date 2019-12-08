<?php

namespace Ocd\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ocd\NewsBundle\Model\NewsTrait;
use Ocd\NewsBundle\Model\MultilangTrait;
use Ocd\NewsBundle\Model\TimestampableTrait;
use Ocd\NewsBundle\Model\NewsTaggableTrait;
use Symfony\Component\HttpFoundation\File\File;
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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="news_backgrounds", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }
}
