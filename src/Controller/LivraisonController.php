<?php

namespace App\Controller;

use App\Entity\Livraison;
use App\Form\LivraisonType;
use App\Repository\CommandeRepository;
use App\Repository\LivraisonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Endroid\QrCode\QrCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCodeBundle\Response\QrCodeResponse;


/**
 * @Route("/livraison")
 */
class LivraisonController extends AbstractController
{

    /**
     * @Route("affiche/{id}", name="livraison_affiche", methods={"GET"})
     */
    public function affiche(Livraison $livraison): Response
    {

        return $this->render('livraison/affiche.html.twig', [
            'livraison' => $livraison,
        ]);
    }
    /**
     * @Route("/", name="livraison_index", methods={"GET"})
     */
    public function index(LivraisonRepository $livraisonRepository): Response
    {
        return $this->render('livraison/index.html.twig', [
            'livraisons' => $livraisonRepository->findAll(),
        ]);
    }
    /**
     * @Route("/minel", name="livraison_minel", methods={"GET"})
     */
    public function mine(LivraisonRepository $livraisonRepository): Response
    {
        return $this->render('livraison/minel.html.twig', [
            'livraisons' => $livraisonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="livraison_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $livraison = new Livraison();
        $form = $this->createForm(LivraisonType::class, $livraison);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($livraison);
            $entityManager->flush();

            return $this->redirectToRoute('livraison_minel', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livraison/new.html.twig', [
            'livraison' => $livraison,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="livraison_show", methods={"GET"})
     */
    public function show(Livraison $livraison): Response
    {
        return $this->render('livraison/show.html.twig', [
            'livraison' => $livraison,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="livraison_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Livraison $livraison, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LivraisonType::class, $livraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();


            return $this->redirectToRoute('livraison_show', ['id'=>$livraison->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livraison/edit.html.twig', [
            'livraison' => $livraison,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/modifier", name="livraison_modifier", methods={"GET", "POST"})
     */
    public function modifier(Request $request, Livraison $livraison, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LivraisonType::class, $livraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('livraison_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livraison/modifier.html.twig', [
            'livraison' => $livraison,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="livraison_delete", methods={"POST"})
     */
    public function delete(Request $request, Livraison $livraison, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livraison->getId(), $request->request->get('_token'))) {
            $entityManager->remove($livraison);
            $entityManager->flush();
        }

        return $this->redirectToRoute('livraison_minel', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("supp/{id}", name="livraison_supp", methods={"POST"})
     */
    public function supp(Request $request, Livraison $livraison, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livraison->getId(), $request->request->get('_token'))) {
            $entityManager->remove($livraison);
            $entityManager->flush();
        }

        return $this->redirectToRoute('livraison_index', [], Response::HTTP_SEE_OTHER);
    }

    public function __construct(BuilderInterface $customQrCodeBuilder)
    {
        $result = $customQrCodeBuilder
            ->size(400)
            ->margin(20)
            ->build();

    }
}
