<?php

namespace Ocd\NewsBundle\Provider;

use Symfony\Component\HttpFoundation\Request;
use Ocd\NewsBundle\Repository\NewsTagRepository;

class NewsTagProvider
{
    protected $newsTagRepository;

    public function __construct(NewsTagRepository $newsTagRepository)
    {
        $this->newsTagRepository = $newsTagRepository;
    }

    public function getTagList()
    {
        $tags = $this->newsTagRepository->findAll();
        return $tags;
    }

    public function getTagsFromRequest(Request $request):array
    {
        $tags = [];
        if ($request->query->has('tag')) {
            $queryTag = $request->query->get('tag');
            $delimiters = [';',',','|', ' '];
            $delimited = false;
            foreach ($delimiters as $delimiter) {
                if (strpos($queryTag, $delimiter)>0) {
                    $tagsArray = explode($delimiter, $queryTag);
                    foreach ($tagsArray as $tagString) {
                        $tag = $this->newsTagRepository->findOneBy(['name' => $tagString]);
                        $tags[] = $tag;
                    }
                    $delimited = true;
                    break;
                }
            }
            if (false === $delimited) {
                $tag = $this->newsTagRepository->findOneBy(['name' => $queryTag]);
                $tags[] = $tag;
            }
        }
        return $tags;
    }
}


