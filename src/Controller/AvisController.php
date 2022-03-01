<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Rendezvous;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AvisController extends AbstractController
{
    /**
     * @Route("/avis", name="avis_index", methods={"GET"})
     */
    public function index(AvisRepository $avisRepository): Response
    {
        return $this->render('avis/index.html.twig', [
            'avis' => $avisRepository->findAll(),
        ]);
    }
    /**
     * @Route("/avis/Afficheback", name="avis_back", methods={"GET"})
     */
    public function AfficheBack(AvisRepository $avisRepository): Response
    {
        return $this->render('avis/AfficheBack.html.twig', [
            'avis' => $avisRepository->findAll(),
        ]);
    }

    /**
     * @Route("/avis/stats", name="statAvis")
     */
    public function stat()
    {
        $repository = $this->getDoctrine()->getRepository(Avis::class);
        $avis = $repository->findAll();

        $em = $this->getDoctrine()->getManager();

        $r1=0;
        $r2=0;
        $r3=0;
        $r4=0;
        $r5=0;

        foreach ($avis as $avi)
        {
            if ( $avi->getEtatService()=="Excellent")  :

                $r1+=1;
            elseif( $avi->getEtatService()=="Bien") :

                $r2+=1;
            elseif( $avi->getEtatService()=="Moyen") :

                $r3+=1;
            elseif( $avi->getEtatService()=="Mauvais") :

                $r4+=1;
            else :
                $r5+=1;
            endif;

        }

        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Etat_service', 'nombre'],
                ['Excellent', $r1],
                ['Bien', $r2],
                ['Moyen', $r3],
                ['Mauvais', $r4],
                ['Catastrophique', $r5],
            ]
        );
        $pieChart->getOptions()->setTitle('Les etats des services ');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('avis/stat.html.twig', array('piechart' => $pieChart));
    }
    /**
     * @Route("/avis/tri", name="triavis")
     */
    public function Tri(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $query = $em->createQuery(
            'SELECT n FROM App\Entity\Avis n
            ORDER BY n.recommendation '
        );

        $avis = $query->getResult();



        return $this->render('avis/AfficheBack.html.twig',
            array('avis' => $avis));

    }

    /**
     * @Route("/avis/{rendezvous}/new", name="avis_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, $rendezvous): Response
    {
        $avi = new Avis();
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $r = $this->getDoctrine()->getRepository(Rendezvous::class)->find($rendezvous);
            $avi->setRendezvous($r);
            $entityManager->persist($avi);
            $entityManager->flush();


            return $this->redirectToRoute('avis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('avis/new.html.twig', [
            'avi' => $avi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/avis/{id}", name="avis_show", methods={"GET"})
     */
    public function show(Avis $avi): Response
    {
        return $this->render('avis/show.html.twig', [
            'avi' => $avi,
        ]);
    }

    /**
     * @Route("/avis/{id}/edit", name="avis_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('avis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('avis/edit.html.twig', [
            'avi' => $avi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/avis/{id}", name="avis_delete", methods={"POST"})
     */
    public function delete(Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avi->getId(), $request->request->get('_token'))) {
            $entityManager->remove($avi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('avis_index', [], Response::HTTP_SEE_OTHER);
    }
}
