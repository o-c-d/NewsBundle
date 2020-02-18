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
        return substr($mappingName, strlen('news_'));
        $createdAtString = $news->getCreatedAt() ?? date("YmdHi");
        return (string) $this->getNewsId($news).'/'.substr($mappingName,strlen('news_'));
    }
    protected function getNextAutoIncrementedId($object) {
        $meta = $this->em->getClassMetadata(get_class($object));
        if(!$meta) return null;

        $conn = $this->em->getConnection();
        $dbName = basename($conn->getDatabase());
        $table = $meta->getTableName();
        if(substr($dbName,-3)==='.db') {
            // sqlite
            $sql = "SELECT * FROM sqlite_sequence WHERE NAME = '$table'";

        } else {
            // mysql
            $sql = "SHOW TABLE STATUS FROM `$dbName` LIKE '$table'";

        }
        $result = $conn->query($sqlite)->fetch(\PDO::FETCH_ASSOC);
        if(substr($dbName,-3)==='.db') {
            if(empty($result['seq'])) return null;
            return $result['seq'];        
        } else {
            if(empty($result['Auto_increment'])) return null;
            return $result['Auto_increment'];
        }
    }

    private function getNewsId($news)
    {
        $newsId = $news->getId();
        if($newsId) return $newsId;
        return $this->getNextAutoIncrementedId($news);
    }
}

