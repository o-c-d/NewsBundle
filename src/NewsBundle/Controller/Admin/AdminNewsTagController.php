<?php

namespace Ocd\NewsBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Ocd\NewsBundle\Repository\NewsRepository;
use Ocd\NewsBundle\Repository\NewsTagRepository;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Ocd\NewsBundle\Entity\News;
use Ocd\NewsBundle\Form\NewsType;

/**
 * Admin News Controller
 *
 * @Route("/ocdnewsbundle/admin/news", name="ocdnews_admin_news_")
 */
class AdminNewsController extends AbstractController
{
    private $em;
    private $paginator;
    private $session;

    public function __construct(EntityManagerInterface $em, PaginatorInterface $paginator, SessionInterface $session)
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
        $newsQuery->select('news')->from(News::class, 'news');

        $newsQuery
            ->orderBy('news.publishedAt', 'DESC');

        $defaultNumItemsPerPage = 10 ;

        $newsList = $this->paginator->paginate(
            $newsQuery->getQuery(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            $request->query->getInt('numItemsPerPage', $request->getSession()->get('numItemsPerPage', $defaultNumItemsPerPage)) /*limit per page*/
        );

        return $this->render('@OcdNews/admin/news/list.html.twig', [
            'news' => $newsList,
            'tags' => $tags,
            ]);
    }

    /**
     * @Route("/create", methods={"GET", "POST"}, name="create")
     */
    public function create(Request $request, NewsRepository $newsRepository, NewsTagRepository $tagsRepository): Response
    {
        $news = new News;
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            if ($news) {
                $this->em->persist($news);
                $this->em->flush();
                $this->addFlash(
                    'notice',
                    'La news a bien été ajoutée : '
                );
                return $this->redirectToRoute('admin_news_list');
            } else {
                $this->addFlash(
                    'error',
                    'Erreur lors de la création de la news : '
                );
            }
        }
        return $this->render('@OcdNews/admin/news/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/show/{id}", methods={"GET"}, name="show")
     */
    public function show(int $id, Request $request, NewsRepository $newsRepository, NewsTagRepository $tagsRepository): Response
    {
        $news = $newsRepository->find($id);
        return $this->render('@OcdNews/admin/news/show.html.twig', array(
            'news' => $news
        ));
    }

    /**
     * @Route("/edit/{id}", methods={"GET", "POST"}, name="edit")
     */
    public function edit(int $id, Request $request, NewsRepository $newsRepository, NewsTagRepository $tagsRepository): Response
    {
        $news = $newsRepository->find($id);
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            if ($news) {
                $this->em->merge($news);
                $this->em->flush();
                $this->addFlash(
                    'notice',
                    'La news a bien été mise à jour : '
                );
                return $this->redirectToRoute('admin_news_list');
            } else {
                $this->addFlash(
                    'error',
                    'Erreur lors de la mise à jour de la news : '
                );
            }
        }
        return $this->render('@OcdNews/admin/news/edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/delete/{id}", methods={"GET"}, name="delete")
     */
    public function delete(int $id, Request $request, NewsRepository $newsRepository, NewsTagRepository $tagsRepository): Response
    {
        $news = $newsRepository->find($id);
        if ($request->request->get('confirm')) {
            $this->em->remove($news);
            $this->em->flush();

            $this->addFlash(
            'notice',
            'La news a bien été supprimée !'
            );
            return $this->redirectToRoute('admin_news_list');
        }
        return $this->render('@OcdNews/admin/news/delete.html.twig', array(
            'news' => $news
        ));
    }

}