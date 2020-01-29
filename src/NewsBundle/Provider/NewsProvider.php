<?php

namespace Ocd\NewsBundle\Provider;

use Symfony\Component\HttpFoundation\Request;
use Ocd\NewsBundle\Repository\NewsRepository;

class NewsProvider
{
    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository, NewsTagProvider $newsTagProvider)
    {
        $this->newsRepository = $newsRepository;
        $this->newsTagProvider = $newsTagProvider;
    }
    
    public function getLatestNews(Request $request, int $limitPerPage, int $page)
    {
        $tags = $this->newsTagProvider->getTagsFromRequest($request);
        return $this->newsRepository->findLatest($limitPerPage, $page, $tags);

    }
}


