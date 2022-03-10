<?php

namespace App\Controller;

use App\Entity\CarteFidelite;
use App\Entity\Offre;
use App\Form\Offre1Type;
use App\Form\OffreType;
use App\Repository\OffreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator


/**
 * @Route("/offre")
 */
class OffreController extends AbstractController
{
    /**
     * @Route("/", name="offre_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Offre::class)->findAll();

        $offre = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page
        );
        return $this->render('offre/index.html.twig', [
            'offres' => $offre,
        ]);
    }

    /**
     * @Route("/new", name="offre_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $offre = new Offre();
        $form = $this->createForm(Offre1Type::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $fich = $offre->getImage();
            $fileName = md5(uniqid()).'.'.$fich->guessExtension();
            try {
                $fich->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e){

            }
            $offre->setImage($fileName);

            $entityManager->persist($offre);
            $entityManager->flush();

            return $this->redirectToRoute('offre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offre/new.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="offre_show", methods={"GET"})
     */
    public function show(Request $request,Offre $offre, EntityManagerInterface $entityManager, OffreRepository $offreRepository): Response
    {

        
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);
        $user = $this->getUser();
        $carte = $this->getDoctrine()->getRepository(CarteFidelite::class)->find($user->getIdcarte());

        $pts = $offre->getPoints();
        $old = $carte->getNbPoints() ;    
        $whida = $offreRepository->find(1);

        /** @var ClickableInterface $button  */
        $button = $form->get("submit");


        
            
           $carte->setNbPoints($old+$pts) ;
           if ($carte->getNbPoints() >= 100 && $carte->getNbPoints() < 500 ){
            $carte->setType(1) ;
           }elseif ($carte->getNbPoints() >= 500 && $carte->getNbPoints() < 1000) {
            $carte->setType(2) ;
           }elseif ($carte->getNbPoints() >= 1000) {
            $carte->setType(3) ;
           }
           $entityManager->persist($carte);
           $entityManager->flush();

           
        
        return $this->render('offre/show.html.twig', [
            'offre' => $offre,'form' => $form->createView(),
            'whida' => $whida
        ]);
    }

    /**
     * @Route("/{id}/edit", name="offre_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Offre $offre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Offre1Type::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->flush();

            return $this->redirectToRoute('offre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offre/edit.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="offre_delete", methods={"POST"})
     */
    public function delete(Request $request, Offre $offre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($offre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('offre_index', [], Response::HTTP_SEE_OTHER);
    }



    public function __toString()
    {
        return $this->type;
    }
}
