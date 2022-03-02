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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
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
     * @Route("/avis/excel", name="excel", methods={"GET"})
     */
    public function excel()
    {
        $spreadsheet = new Spreadsheet();

        /* @var $sheet \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet */
        // on définie les en têtes de nos enregistrements
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1','ID')
            ->setCellValue('B1','Etat Services')
            ->setCellValue('C1','Recommendation')
            ->setCellValue('D1','Description')
            ->setCellValue('E1','Date de publication')

        ;
        // on récupère toutes les personnes ou on fait une fonction personnalisée à la place du findAll
        $em = $this->getdoctrine()->getManager();
        $avis = $em->getRepository(Avis :: class)->findAll();
        // on place le curseur dans la 2ème position pour ne pas écraser les entêtes ...<br>
        $aux = 2;
        foreach ($avis as $row)
            // donc pour chaque personne trouvée dans la base de données il met les valeurs au dessous des entêtes
        {
            $sheet->setSheetState(0)
                ->setCellValue('A'.$aux, $row->getId())
                ->setCellValue('B'.$aux, $row->getEtatService())
                ->setCellValue('C'.$aux, $row->getRecommendation())
                ->setCellValue('D'.$aux, $row->getDescriptionService())
                ->setCellValue('E'.$aux, $row->getDate())

            ;
            //aux au début était 2 lorsqu'on écrit on l'incrémente pour ne pas écraser à chaque fois
            $aux++;
        };
        $sheet->setTitle("Les Avis Bilan");

        // Create your Office 2007 Excel (XLSX Format)
        $writer = new Xlsx($spreadsheet);

        // Create a Temporary file in the system
        $fileName = 'Candidature stage.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        // Create the excel file in the tmp directory of the system
        $writer->save($temp_file);

        // Return the excel file as an attachment
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
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
