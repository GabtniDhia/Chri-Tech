<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/utilisateur", name="utilisateur")
     */
    public function usersList(UserRepository $user){
        return $this->render("admin/user.html.twig", [
            'user' => $user->findAll()
        ]);
    }

    /**
     * Modifier un Utilisateur
     * @Route("/utilisateur/modifier/{id}", name="modifier_utilisateur")
     */
    public function editUser(User $user, Request $request){
        $form = $this -> createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message' , 'Utilisateur Modifier Avec Succes');
            return $this->redirectToRoute('admin_utilisateur');
        }

        return $this->render('admin/edituser.html.twig' , [
            'userForm' => $form ->createView()
        ]);
    }

    /**
     * Supprimer un Utilisateur
     * @Route("/utilisateur/supprimer/{id}", name="supprimer_utilisateur")
     */
    public function suppUser($id, UserRepository $repository){
        $utilisateur=$repository->find($id);
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->remove($utilisateur);
        $entityManager->flush();
        return $this->redirectToRoute('admin_utilisateur');
    }
}
