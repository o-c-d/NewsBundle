<?php

namespace Ocd\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Ocd\NewsBundle\Provider\NewsProvider;
use Ocd\NewsBundle\Provider\NewsTagProvider;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Ocd\NewsBundle\Entity\News;
use Ocd\NewsBundle\Entity\NewsTag;

/**
 * @Route({
 *     "fr": "/ocdnewsbundle/actualites",
 *     "en": "/ocdnewsbundle/news"
 * }, name="ocdnews_")
 */
class NewsController extends AbstractController
{
    /**
     * News Provider
     *
     * @var NewsProvider
     */
    protected $newsProvider;

    /**
     * NewsTag Provider
     *
     * @var NewsTagProvider
     */
    protected $newsTagProvider;

    public function __construct(NewsProvider $newsProvider, NewsTagProvider $newsTagProvider)
    {
        $this->newsProvider = $newsProvider;
        $this->newsTagProvider = $newsTagProvider;
    }

    /**
     * @Route("/", defaults={"page": "1", "_format"="html"}, methods={"GET"}, name="index")
     * @Route("/rss.xml", defaults={"page": "1", "_format"="xml"}, methods={"GET"}, name="rss")
     * @Route("/page/{page<[1-9]\d*>}", defaults={"_format"="html"}, methods={"GET"}, name="index_paginated")
     */
    public function index(Request $request, int $page, string $_format): Response
    {
        $locale = $request->getLocale();
        $latestNews = $this->newsProvider->getLatestNews($request, $page);

        return $this->render('@OcdNews/news/index.'.$_format.'.twig', [
            'locale' => $locale,
            'latestNews' => $latestNews
        ]);
    }

    /**
     * @Route({
     *     "fr": "/{slug}",
     *     "en": "/{slug}"
     * }, name="show", methods={"GET"})
     */
    public function show(Request $request, News $news): Response
    {
        $locale = $request->getLocale();
        // Symfony's 'dump()' function is an improved version of PHP's 'var_dump()' but
        // it's not available in the 'prod' environment to prevent leaking sensitive information.
        // It can be used both in PHP files and Twig templates, but it requires to
        // have enabled the DebugBundle. Uncomment the following line to see it in action:
        //
        // dump($post, $this->getUser(), new \DateTime());

        return $this->render('@OcdNews/news/show.html.twig', [
            'locale' => $locale,
            'news' => $news
        ]);
    }

    public function renderLatest(int $page = 1, array $tags = [])
    {
        $latestNews = $this->newsRepository->findLatest($page, $tags);
        return $this->render('@OcdNews/news/_latest.html.twig', ['latestNews' => $latestNews]);

    }

}