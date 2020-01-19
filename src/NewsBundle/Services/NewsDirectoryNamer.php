<?php

namespace Ocd\NewsBundle\Services;

use Vich\UploaderBundle\Naming\DirectoryNamerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;

class NewsDirectoryNamer implements DirectoryNamerInterface
{
    public function directoryName($news, PropertyMapping $mapping):string
    {
        $mappingName = $mapping->getMappingName();
        return (string) $news->getId().'/'.substr($mappingName,strlen('news_'));
    }
}

