<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Blog;
use App\Entity\Postlike;
use App\Entity\User;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use App\Repository\PostlikeRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use Snipe\BanBuilder\CensorWords;



/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/", name="blog_index", methods={"GET"})
     */
    public function index(BlogRepository $blogRepository): Response
    {
        return $this->render('blog/index.html.twig', [
            'blogs' => $blogRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="blog_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('img')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName

                );
            } catch (FileException $e){

            }
            $blog->setImg($fileName);
            $entityManager->persist($blog);
            $entityManager->flush();

            return $this->redirectToRoute('blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('blog/new.html.twig', [
            'blog' => $blog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blog_show", methods={"GET", "POST"})
     */
    public function show(
        Blog $blog,
        request $request,
        EntityManagerInterface $entitymanager,
    ): Response{

        $commentaire = new Commentaire();
        $form = $this->createform(CommentaireType::class, $commentaire );
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            if(!$this->getUser()){
                return $this->redirectToRoute('app_login');
            }else{
                $blog->getId();
                $censor = new CensorWords;
                $data = $form->getData();
                $string = $censor->censorString($data->getContenue());
                $commentaire->setContenue($string['clean']);
                $commentaire->setBlogId($blog);
                $commentaire->setUserFK($this->getUser());
                $entitymanager->persist($commentaire);
                $entitymanager->flush();
                //clearing form
                unset($commentaire);
                unset($form);
                $commentaire= new Commentaire();
                $form = $this->createForm(CommentaireType::class, $commentaire);
            }

        }

        return $this->render('blog/show.html.twig', [
            'blog' => $blog,
            'form' => $form->createView(),
            'commentaire' => $commentaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="blog_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Blog $blog, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('blog/edit.html.twig', [
            'blog' => $blog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="blog_delete", methods={"POST"})
     */
    public function delete(Request $request, Blog $blog, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blog->getId(), $request->request->get('_token'))) {
            $entityManager->remove($blog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('blog_index', [], Response::HTTP_SEE_OTHER);
    }

    public function createAction(Request $request)
    {
        // en créant un object Article, le constructeur de l'entité Article initialise la date à la date du jour.
        // Le formulaire symfony se chargera d'hydrater ton input date avec la valeur du champ date de l'entité article
        $form = $this->createFormBuilder(new Blog()); //nul besoin de set la date grâce au constructeur
        // ...
    }


    /**
     * Permet de liker un blog
     *
     * @Route ("/{id}/like", name="blog_like", methods={"GET", "POST"})
     *
     * @param Blog $blog
     * @param EntityManagerInterface $manager
     * @param PostlikeRepository $likerepo
     * @return Response
     */
    public function like(blog $blogL, EntityManagerInterface $manager, PostlikeRepository $likerepo) :
    Response {
        $userL = $this->getUser();

        if(!$userL) return $this->json([
            'code' => 403,
            'message' => "unauthorized"
        ], 403);

        if($blogL->isLikedByUser($userL)) {
            $like = $likerepo->findOneBy([
                'blogL' => $blogL,
                'userL' => $userL
            ]);

            $manager->remove($like);
            $manager->flush();

            return $this->json([
                'code' => 200,
                'message' => 'like supprimé',
                'likes' => $likerepo->count(['blogL' => $blogL])
            ], 200);
        }

        $like = new postlike();
        $like->setBlogL($blogL)
             ->setUserL($userL);

        $manager->persist($like);
        $manager->flush();

        return $this->json([
            'code' => 200,
            'message' => 'ca marche bien',
            'likes' => $likerepo->count(['blogL' => $blogL])
        ], 200);
    }


}
