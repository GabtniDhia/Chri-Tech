<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use App\Form\ArticleType;
use App\Form\EditUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;


    /**
     * @Route("/admin", name="admin_")
     */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * Affichage de la liste des Utilisateurs
     *
     * @Route("/admins", name="admins")
     */
    public function adminList(UserRepository $user){
        return $this->render("admin/admins.html.twig", [
            'user' => $user->findAll()
        ]);
    }

    /**
     * Affichage de la liste des Utilisateurs
     *
     * @Route("/clients", name="clients")
     */
    public function clientList(UserRepository $user){
        return $this->render("admin/clients.html.twig", [
            'user' => $user->findAll()
        ]);
    }

    /**
     * Affichage de la liste des Utilisateurs
     *
     * @Route("/specialistes", name="specialistes")
     */
    public function specList(UserRepository $user){
        return $this->render("admin/specialistes.html.twig", [
            'user' => $user->findAll()
        ]);
    }

    /**
     * Traiter les demandes des sepecialistes
     *
     * @Route("/demande", name="demande")
     */
    public function demande(UserRepository $user){
        return $this->render("admin/specialistes.html.twig", [
            'user' => $user->findAll()
        ]);
    }

    /**
     * Modifier un Utilisateur
     * @Route("/utilisateur/modifier/{id}/{route}", name="modifier_utilisateur")
     */
    public function editUser($route , User $user, Request $request){
        $form = $this -> createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $file = $user->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e){

            }
            $user->setImage($fileName);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message' , 'Utilisateur Modifier Avec Succes');
            if($route == 'admin_clients' ){
                return $this->redirectToRoute('admin_clients');
            }elseif ($route == 'admin_specialistes' ){
                return $this->redirectToRoute('admin_specialistes');
            }else{
                return $this->redirectToRoute('admin_admins');
            }
        }

        return $this->render('admin/edituser.html.twig' , [
            'userForm' => $form ->createView()
        ]);
    }

    /**
     * Supprimer un Utilisateur
     * @Route("/utilisateur/supprimer/{id}/{route}", name="supprimer_utilisateur")
     */
    public function suppUser($route , $id, UserRepository $repository, Request $request){
        $utilisateur=$repository->find($id);
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->remove($utilisateur);
        $entityManager->flush();
        if($route == 'admin_clients' ){
            return $this->redirectToRoute('admin_clients');
        }elseif ($route == 'admin_specialistes' ){
            return $this->redirectToRoute('admin_specialistes');
        }else{
            return $this->redirectToRoute('admin_admins');
        }

    }

    /**
     * @Route("/new", name="article_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

}
