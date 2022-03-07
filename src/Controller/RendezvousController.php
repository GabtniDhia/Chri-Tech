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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    public function AfficheBack(RendezvousRepository $rendezvousRepository): Response
    {


        return $this->render('rendezvous/AfficheBack.html.twig', [
            'rendezvous' => $rendezvousRepository->findAll(),
        ]);
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
        $pieChart->getOptions()->setTitle('Services Le plus demandé ');
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
            ORDER BY n.service Desc, n.telephonenum'
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


}
