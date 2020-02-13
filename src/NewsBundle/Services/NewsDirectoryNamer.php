<?php

namespace Ocd\NewsBundle\Services;

use Vich\UploaderBundle\Naming\DirectoryNamerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Doctrine\ORM\EntityManagerInterface;


class NewsDirectoryNamer implements DirectoryNamerInterface
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function directoryName($news, PropertyMapping $mapping):string
    {
        $mappingName = $mapping->getMappingName();
        return (string) $this->getNewsId($news).'/'.substr($mappingName,strlen('news_'));
    }
    protected function getNextAutoIncrementedId($object) {
    $meta = $this->em->getClassMetadata(get_class($object));
    if(!$meta) return null;

    $conn = $this->em->getConnection();
    $table = $meta->getTableName();
    $sql = "SHOW TABLE STATUS WHERE `Name` = '$table'";
    $result = $conn->query($sql)->fetch(\PDO::FETCH_ASSOC);
    if(empty($result['Auto_increment'])) return null;

    return $result['Auto_increment'];
    }

    private function getNewsId($news)
    {
        $newsId = $news->getId();
        if($newsId) return $newsId;
        return $this->getNextAutoIncrementedId($news);
    }
}

