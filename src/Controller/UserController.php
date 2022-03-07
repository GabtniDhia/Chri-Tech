<?php

namespace App\Controller;

use App\Entity\DemandeSpec;
use App\Form\DemandeSpecType;
use App\Form\ModifUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use App\Security\UserAuthentificatorAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class UserController extends AbstractController
{
    private $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

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
        $email = $this->getUser()->getEmail();
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
            $data = $form->getData();
            if ($data->getEmail() != $email){
                $user->setIsVerified(false);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                    (new TemplatedEmail())
                        ->from(new Address('chritechverify@gmail.com', 'Verify'))
                        ->to($user->getEmail())
                        ->subject('Please Confirm your Email')
                        ->htmlTemplate('registration/confirmation_email.html.twig')
                );
                $this->addFlash('message', 'Profil Mis A jour , Veuillez Verifier Votre Nouveau Mail');
        }else{
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $this->addFlash('message', 'Profil Mis A jou');
            }
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
