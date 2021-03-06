<?php

namespace App\Controller;

use App\Entity\CarteFidelite;
use App\Form\CarteFideliteType;
use App\Repository\CarteFideliteRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twilio\Rest\Client;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse as ResponsePdfResponse;
use Knp\Snappy\Pdf as Pdf ;

/**
 * @Route("/carte")
 */
class CarteFideliteController extends AbstractController
{
    /**
     * @Route("/", name="carte_fidelite_index", methods={"GET"})
     */
    public function index(CarteFideliteRepository $carteFideliteRepository): Response
    {
        return $this->render('carte_fidelite/index.html.twig', [
            'carte_fidelites' => $carteFideliteRepository->findAll(),
        ]);
    }

     /**
     * @Route("/test2", name="statique", methods={"GET"})
     */
    public function statique(CarteFideliteRepository $carteFideliteRepository): Response
    {
        return $this->render('cartefidelite.html.twig', [
            'carte_fidelites' => $carteFideliteRepository->findAll(),
        ]);
    }

     /**
     * @Route("/cartes", name="cartes", methods={"GET"})
     */
    public function statique2(CarteFideliteRepository $carteFideliteRepository): Response
    {
        return $this->render('cartes.html.twig', [
            'carte_fidelites' => $carteFideliteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="carte_fidelite_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,Client $twilioClient): Response
    {
        $carteFidelite = new CarteFidelite();
        $form = $this->createForm(CarteFideliteType::class, $carteFidelite);
        $form->handleRequest($request);

        $user = $this->getUser();
       
        if ($form->isSubmitted() && $form->isValid()) {

            $phone = $request->request->get('phone');

            $twilioClient->messages->create("+216".$phone, [
                "body" => "Votre Carte de fidelit?? ?? ??t?? cr??e avec succ??s",
                "from" => $this->getParameter('twilio_number')
            ]);


            $carteFidelite->setIdUser($user->getId());
            $carteFidelite->setDateCreation(new \DateTime());
            $carteFidelite->setNbPoints(0);
            $carteFidelite->setType(0);
            $carteFidelite->setTel($phone);
            $datetime = new DateTime();
            $datetime->modify('+1 year');
            $carteFidelite->setDateExpiration($datetime);
            
            
            $entityManager->persist($carteFidelite);
            $entityManager->flush();



    $user->setIdcarte($carteFidelite);
    $entityManager->persist($user);
    $entityManager->flush();



            return $this->redirectToRoute('carte_fidelite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('carte_fidelite/new.html.twig', [
            'carte_fidelite' => $carteFidelite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_fidelite_show", methods={"GET"})
     */
    public function show(CarteFidelite $carteFidelite): Response
    {
        return $this->render('carte_fidelite/show.html.twig', [
            'carte_fidelite' => $carteFidelite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carte_fidelite_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CarteFidelite $carteFidelite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CarteFideliteType::class, $carteFidelite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('carte_fidelite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('carte_fidelite/edit.html.twig', [
            'carte_fidelite' => $carteFidelite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_fidelite_delete", methods={"POST"})
     */
    public function delete(Request $request, CarteFidelite $carteFidelite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carteFidelite->getId(), $request->request->get('_token'))) {
            $entityManager->remove($carteFidelite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carte_fidelite_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/pdf/{id}", name="pdf_res")
     */

    public function pdfAction(Pdf $snappy , $id)
    {
        $carte = $this->getDoctrine()->getRepository(CarteFidelite::class)->find($id);
        $html = $this->renderView('carte_fidelite/pdf.html.twig', array('carte'  => $carte));

        return new ResponsePdfResponse(
            $snappy->getOutputFromHtml($html),
            'file.pdf'
        );
    }

}
