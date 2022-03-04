<?php

namespace App\Controller;

use App\Entity\DemandeSpec;
use App\Form\DemandeSpecType;
use App\Form\ModifUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\EditUserType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Serializer;
class UserController extends AbstractController
{

    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig');
    }

    /**
     * @Route("/user/profil/modifier", name="user_profil_modifier")
     */
    public function modif(Request $request){
        $user = $this->getUser();
        $form = $this->createForm(ModifUserType::class, $user);

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
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profil Mis a Jour');
            return $this->redirectToRoute('home');
        }
        return $this->render('user/editprofil.html.twig', [
            'userForm' => $form->createView(),
        ]);
        }

    /**
     * @Route("/spec", name="specialiste")
     */
    public function spec(Request $request): Response
    {
        $demande = new DemandeSpec();

        $form = $this->createForm(DemandeSpecType::class, $demande);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $file = $demande->getCerif();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('certif_directory'),
                    $fileName
                );
            } catch (FileException $e){

            }
            $demande->setCerif($fileName);
            $demande->setDemandeur($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($demande);
            $em->flush();

            $this->addFlash('succes', 'Demande Evnoyer Avec Succés');
            return $this->redirectToRoute('home');
        }elseif($form->isSubmitted() && !($form->isValid())){
            $this->addFlash('echec', 'Echec De l Envoi');
            return $this->redirectToRoute('home');
        }
        return $this->render('Specialiste/spec.html.twig', [
            'formD' => $form->createView()
        ]);
    }
}
