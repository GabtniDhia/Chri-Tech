<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Livraison;
use App\Entity\User;
use App\Form\CommandeType;
use App\Form\LivraisonType;
use App\Repository\CommandeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Security\EmailVerifier;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;

use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Mime\Address;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
* @Route("/commande")
*/
class CommandeController extends AbstractController
{
    private $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }
    /**
     * @Route("/", name="commande_index", methods={"GET"})
     */
    public function index(CommandeRepository $commandeRepository): Response
    {
        return $this->render('commande/index.html.twig', [
            'commandes' => $commandeRepository->findAll(),
        ]);
    }
    /**
     * @Route("/mine", name="commande_mine")
     */
    public function mine(CommandeRepository $commandeRepository): Response
    {
        $user = $this->getUser();
        return $this->render('commande/mine.html.twig', [
            'commandes' => $commandeRepository->cmnds($user),
        ]);
    }


    /**
     * @Route("/new", name="commande_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $commande = new Commande();
        $livraison = new Livraison();
        $user = $this->getUser();
        $commande->setCommandel($livraison);
        $form = $this->createForm(CommandeType::class, $commande);
        $forma = $this->createForm(LivraisonType::class, $livraison);
        $form->handleRequest($request);
        $forma->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $forma->isSubmitted() && $forma->isValid()) {
            $commande->setUser($this->getUser());
            $entityManager->persist($commande);
            $entityManager->persist($livraison);
            $entityManager->flush();

            if ($livraison->getAdresse())
            {$adresseGps = str_replace("","+",$livraison->getAdresse());}
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('chritechverify@gmail.com', 'Verify'))
                    ->to($user->getEmail())
                    ->subject('Chritech: Confirmation de votre achat!')
                    ->htmlTemplate('commande/livraisonmail.html.twig')
            );
            return $this->redirectToRoute('commande_show', ['id'=>$commande->getId()], Response::HTTP_SEE_OTHER);

        }

        return $this->render('commande/new.html.twig', [
            'commande' => $commande,
            'livraison' => $livraison,
            'form' => $form->createView(),
            'forma' => $forma->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="commande_show", methods={"GET"})
     */
    public function show(Commande $commande): Response
    {
        return $this->render('commande/show.html.twig', [
            'commande' => $commande,
        ]);
    }
    /**
     * @Route("afficher/{id}", name="commande_afficher", methods={"GET"})
     */
    public function afficher(Commande $commande): Response
    {
        return $this->render('commande/afficher.html.twig', [
            'commande' => $commande,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commande_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Commande $commande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();


            return $this->redirectToRoute('commande_show', ['id'=>$commande->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commande/edit.html.twig', [
            'commande' => $commande,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/modif", name="commande_modif", methods={"GET", "POST"})
     */
    public function modif(Request $request, Commande $commande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            return $this->redirectToRoute('commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commande/modif.html.twig', [
            'commande' => $commande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_delete", methods={"POST"})
     */
    public function delete(Request $request, Commande $commande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commande->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_mine', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("supprimer/{id}", name="commande_supprimer", methods={"POST"})
     */
    public function supprimer(Request $request, Commande $commande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commande->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_index', [], Response::HTTP_SEE_OTHER);
    }



}
