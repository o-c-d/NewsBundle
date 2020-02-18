<?php

namespace Ocd\NewsBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Ocd\NewsBundle\Entity\News;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * NewsTag Trait
 *
 */
trait NewsAttachmentTrait
{

    /**
     * @ORM\Column(type="string", length=255, nullable=false, unique=false)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $attachment;

    /**
     * @Vich\UploadableField(mapping="news_attachments", fileNameProperty="attachment")
     * @var File
     */
    private $attachmentFile;

    public function getName(): string
    {
        if (null===$this->name) {
            return '';
        }
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setAttachmentFile(File $attachmentFile = null)
    {
        $this->attachmentFile = $attachmentFile;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($attachmentFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getAttachmentFile()
    {
        return $this->attachmentFile;
    }

    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;
    }

    public function getAttachment()
    {
        return $this->attachment;
    }

}