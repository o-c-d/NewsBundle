<?php

namespace Ocd\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Ocd\NewsBundle\Repository\NewsRepository;
use Ocd\NewsBundle\Repository\NewsTagRepository;

/**
 * News Controller
 *
 * @Route("/news")
 */
class NewsController extends AbstractController
{
    /**
     * @Route("/", defaults={"page": "1", "_format"="html"}, methods={"GET"}, name="news_index")
     * @Route("/rss.xml", defaults={"page": "1", "_format"="xml"}, methods={"GET"}, name="news_rss")
     * @Route("/page/{page<[1-9]\d*>}", defaults={"_format"="html"}, methods={"GET"}, name="news_index_paginated")
     * @Cache(smaxage="10")
     *
     * NOTE: For standard formats, Symfony will also automatically choose the best
     * Content-Type header for the response.
     * See https://symfony.com/doc/current/quick_tour/the_controller.html#using-formats
     */
    public function index(Request $request, int $page, string $_format, NewsRepository $news, NewsTagRepository $tags): Response
    {
        $tag = null;
        if ($request->query->has('tag')) {
            $tag = $tags->findOneBy(['name' => $request->query->get('tag')]);
        }
        $latestNews = $news->findLatest($page, $tag);

        // Every template name also has two extensions that specify the format and
        // engine for that template.
        // See https://symfony.com/doc/current/templating.html#template-suffix
        return $this->render('@OcdNews/news/index.'.$_format.'.twig', ['latest_news' => $latestNews]);
    }

    /**
     * @Route("/{slug}", methods={"GET"}, name="news_show")
     *
     * NOTE: The $news controller argument is automatically injected by Symfony
     * after performing a database query looking for a News with the 'slug'
     * value given in the route.
     * See https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html
     */
    public function show(News $news): Response
    {
        // Symfony's 'dump()' function is an improved version of PHP's 'var_dump()' but
        // it's not available in the 'prod' environment to prevent leaking sensitive information.
        // It can be used both in PHP files and Twig templates, but it requires to
        // have enabled the DebugBundle. Uncomment the following line to see it in action:
        //
        // dump($post, $this->getUser(), new \DateTime());

        return $this->render('@OcdNews/news/show.html.twig', ['post' => $post]);
    }

}