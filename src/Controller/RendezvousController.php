<?php

namespace App\Controller;

use App\Entity\Avis;

use App\Entity\Recherche;
use App\Entity\Rendezvous;
use App\Entity\User;
use App\Form\AvisType;
use App\Form\RendezvousType;
use App\Repository\AvisRepository;
use App\Repository\RendezvousRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Knp\Component\Pager\PaginatorInterface;
// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;


class RendezvousController extends AbstractController
{
    /**
     * @Route("/rendezvous/Afficheback", name="rendezvous_back", methods={"GET"})
     */

    public function AfficheBack(RendezvousRepository $rendezvousRepository,Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'DELETE  FROM App\Entity\Rendezvous n
             WHERE n.date_rendezvous < CURRENT_TIMESTAMP()'
        );

        $rendezvous = $query->getResult();


        return $this->render('rendezvous/AfficheBack.html.twig',
            array('rendezvous' => $rendezvousRepository->findAll()));


    }

    /**
     * @Route("/rendezvous/stats", name="statRendezvous")
     */
    public function stat()
    {
        $repository = $this->getDoctrine()->getRepository(Rendezvous::class);
        $rendezvous = $repository->findAll();

        $em = $this->getDoctrine()->getManager();

        $r1=0;
        $r2=0;

        foreach ($rendezvous as $rendezvou)
        {
            if ( $rendezvou->getService()=="Reparation")  :

                $r1+=1;
            else:

                $r2+=1;


            endif;

        }

        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Service', 'nombre'],
                ['Reparation', $r1],
                ['Installation', $r2],
            ]
        );
        $pieChart->getOptions()->setTitle('Services Le plus demand?? ');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#FFFFFF');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        $pieChart->getOptions()->setBackgroundColor('#454d55');


        return $this->render('rendezvous/stat.html.twig', array('piechart' => $pieChart));
    }

    /**
     * @Route("/rendezvous/tri", name="trirdv")
     */
    public function Tri(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $query = $em->createQuery(
            'SELECT n FROM App\Entity\Rendezvous n
            ORDER BY n.service Desc, n.telephonenum  , n.client'
        );

        $rendezvous = $query->getResult();



        return $this->render('rendezvous/AfficheBack.html.twig',
            array('rendezvous' => $rendezvous));

    }

    /**
     * @Route("/rendezvous/tri2", name="trirdv2")
     */
    public function Tri2(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $query = $em->createQuery(
            'SELECT n FROM App\Entity\Rendezvous n
            ORDER BY n.id'
        );

        $rendezvous = $query->getResult();



        return $this->render('rendezvous/AfficheBack.html.twig',
            array('rendezvous' => $rendezvous));

    }

    /**
     * @Route("/rendezvous", name="rendezvous_index", methods={"GET","POST"})
     */

    public function index(RendezvousRepository $rendezvousRepository, PaginatorInterface $paginator, Request $request): Response

    {
        $rendezvous=new Recherche();
        $form=$this->createFormBuilder($rendezvous)
            ->add('titre',TextType::class,array('attr'=>array('class'=>'form')))
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $term=$rendezvous->getTitre();
            $allrendezvous = $rendezvousRepository->search($term);
        }
        else
        {
            $allrendezvous = $rendezvousRepository->findAll();
        }
        $rendezvousRepository= $paginator->paginate(
            $allrendezvous,
            $request->query->getInt('page',1),
            5
        );
        return $this->render('rendezvous/index.html.twig', [
            'rendezvouses' => $rendezvousRepository,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/rendezvous/calendar", name="rendezvous_calendar")
     */
    public function rendezvous(RendezvousRepository $rendezvousRepository)
    {
        $user = $this->getUser();
        $rendezvous=$rendezvousRepository->rdvs($user);
        $rdvs = [];


        foreach($rendezvous as $rendezvou){

            $rdvs[] = [
                'id' => $rendezvou->getId(),
                'title'=>$rendezvou->getTitre(),
                'titre' => $rendezvou->getTitre(),
                'service' => $rendezvou->getService(),
                'start' => $rendezvou->getDateRendezvous()->format('Y-m-d H:i:s'),
                'description_rendezvous' => $rendezvou->getDescriptionRendezvous(),
                'adressrend' => $rendezvou->getAdressrend(),
                'telephonenum' => $rendezvou->getTelephonenum(),

            ];
        }

        $data = json_encode($rdvs);

        return $this->render('rendezvous/calendar.html.twig', compact('data'));
    }

    /**
     * @Route("/rendezvous/new", name="rendezvous_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rendezvou = new Rendezvous();
        $rendezvou->setClient($this->getUser());
        $form = $this->createForm(RendezvousType::class, $rendezvou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rendezvou);
            $entityManager->flush();

            return $this->redirectToRoute('rendezvous_index', [], Response::HTTP_SEE_OTHER);

        }

        return $this->render('rendezvous/new.html.twig', [
            'rendezvou' => $rendezvou,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/rendezvous/{id}", name="rendezvous_show", methods={"GET"})
     */
    public function show(Rendezvous $rendezvou): Response
    {
        return $this->render('rendezvous/show.html.twig', [
            'rendezvou' => $rendezvou,
        ]);
    }


    /**
     * @Route("/rendezvous/{id}/show1", name="monrendezvous_show1", methods={"GET"})
     */
    public function show1(Rendezvous $rendezvou): Response
    {$pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('rendezvous/monrdv.html.twig', [
            'rendezvou' => $rendezvou,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A6', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
        return $this->redirectToRoute("rendezvous_show");
    }

    /**
     * @Route("/rendezvous/{id}/edit", name="rendezvous_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Rendezvous $rendezvou, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RendezvousType::class, $rendezvou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('rendezvous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rendezvous/edit.html.twig', [
            'rendezvou' => $rendezvou,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/rendezvous/{id}", name="rendezvous_delete", methods={"POST"})
     */
    public function delete(Request $request, Rendezvous $rendezvou, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendezvou->getId(), $request->request->get('_token'))) {
            $entityManager->remove($rendezvou);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rendezvous_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/Rendezvous/excel", name="excel", methods={"GET"})
     */
    public function excel()
    {
        $spreadsheet = new Spreadsheet();

        /* @var $sheet \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet */
        // on d??finie les en t??tes de nos enregistrements
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1','ID')
            ->setCellValue('B1','Titre')
            ->setCellValue('C1','Service')
            ->setCellValue('D1','Date du rendez-vous')
            ->setCellValue('E1','Description du rendez-vous')
            ->setCellValue('F1','Numero de telephone ')
            ->setCellValue('G1','Adresse due Rendez-vous ')

        ;
        // on r??cup??re toutes les personnes ou on fait une fonction personnalis??e ?? la place du findAll
        $em = $this->getdoctrine()->getManager();
        $avis = $em->getRepository(Rendezvous :: class)->findAll();
        // on place le curseur dans la 2??me position pour ne pas ??craser les ent??tes ...<br>
        $aux = 2;
        foreach ($avis as $row)
            // donc pour chaque personne trouv??e dans la base de donn??es il met les valeurs au dessous des ent??tes
        {
            $sheet->setSheetState(0)
                ->setCellValue('A'.$aux, $row->getId())
                ->setCellValue('B'.$aux, $row->getTitre())
                ->setCellValue('C'.$aux, $row->getService())
                ->setCellValue('D'.$aux, $row->getDateRendezvous())
                ->setCellValue('E'.$aux, $row->getDescriptionRendezvous())
                ->setCellValue('F'.$aux, $row->getTelephonenum())
                ->setCellValue('G'.$aux, $row->getAdressrend())

            ;
            //aux au d??but ??tait 2 lorsqu'on ??crit on l'incr??mente pour ne pas ??craser ?? chaque fois
            $aux++;
        };
        $sheet->setTitle("La liste des rendez-vous");

        // Create your Office 2007 Excel (XLSX Format)
        $writer = new Xlsx($spreadsheet);

        // Create a Temporary file in the system
        $fileName = 'liste des rendez vous.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        // Create the excel file in the tmp directory of the system
        $writer->save($temp_file);

        // Return the excel file as an attachment
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
    }

}
