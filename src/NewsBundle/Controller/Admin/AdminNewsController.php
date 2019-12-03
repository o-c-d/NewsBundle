<?php

namespace Ocd\NewsBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Ocd\NewsBundle\Repository\NewsRepository;
use Ocd\NewsBundle\Repository\NewsTagRepository;

/**
 * Admin News Controller
 *
 * @Route("/admin/news", name="admin_news_")
 */
class AdminNewsController extends AbstractController
{
    private $em;
    private $paginator;
    private $session;

    public function __construct(ApiEntityManager $em, PaginatorInterface $paginator, SessionInterface $session)
    {
        $this->em = $em;
        $this->paginator = $paginator;
        $this->session = $session;
    }

    /**
     * @Route("/", methods={"GET"}, name="list")
     */
    public function list(Request $request, NewsRepository $news, NewsTagRepository $tags): Response
    {
        $news->findAll();
        $tags->findAll();

        $newsQuery = $this->em->createQueryBuilder();
        $boxQuery->select('news')->from(News::class, 'news');
        // $selectedClientId = $request->request->get('selected_client_id', 0);
        // if ($selectedClientId>0) {
        //     $selectedClient = $this->em->getRepository(Client::class)->find($selectedClientId);
        //     $boxQuery
        //     ->where('b.client = :client')
        //     ->setParameter(':client', $selectedClient);
        // }

        $boxQuery
            ->orderBy('b.client', 'ASC');
        // $boxes = $boxQuery->getQuery()->getResult();

        // $uri = $this->api->makeUri('boxes/') ;
        // $response = $this->api->sendQuery($uri,'GET') ;
        // $apiUsers = json_decode($response);
        $response = "" ;

        $defaultNumItemsPerPage = 10 ;

        $boxes = $this->paginator->paginate(
            $boxQuery->getQuery(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            $request->query->getInt('numItemsPerPage', $request->getSession()->get('numItemsPerPage', $defaultNumItemsPerPage)) /*limit per page*/
        );

        return $this->render('@OcdNews/admin/news/list.html.twig', [
            'news' => $news,
            'tags' => $tags,
            ]);
    }

    /**
     * @Route("/create", methods={"GET"}, name="create")
     */
    public function create(Request $request, NewsRepository $news, NewsTagRepository $tags): Response
    {
    }

    /**
     * @Route("/edit/{id}", methods={"GET"}, name="edit")
     */
    public function edit(int $id, Request $request, NewsRepository $news, NewsTagRepository $tags): Response
    {
    }

}