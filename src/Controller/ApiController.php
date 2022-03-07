<?php

namespace App\Controller;
use DateTime;
use App\Entity\Rendezvous;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
    /**
     * @Route("/api/{id}/edit", name="api_event_edit", methods={"PUT"})
     */
    public function majEvent(?Rendezvous $rendezvous, Request $request)
    {
        // On récupère les données
        $donnees = json_decode($request->getContent());

        if(

            isset($donnees->titre) && !empty($donnees->titre) &&
            isset($donnees->service) && !empty($donnees->service) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->description_rendezvous) && !empty($donnees->description_rendezvous) &&
            isset($donnees->adressrend) && !empty($donnees->adressrend) &&
            isset($donnees->telephonenum) && !empty($donnees->telephonenum)
        ){
            // Les données sont complètes
            // On initialise un code
            $code = 200;

            // On vérifie si l'id existe
            if(!$rendezvous){
                // On instancie un rendez-vous
                $rendezvous = new Rendezvous();

                // On change le code
                $code = 201;
            }

            // On hydrate l'objet avec les données
            $rendezvous->setTitre($donnees->titre);
            $rendezvous->setService($donnees->service);
            $rendezvous->setDateRendezvous(new DateTime($donnees->start));
            $rendezvous->setDescriptionRendezvous($donnees->description_rendezvous);
            $rendezvous->setAdressrend($donnees->adressrend);
            $rendezvous->setTelephonenum($donnees->telephonenum);

            $em = $this->getDoctrine()->getManager();
            $em->persist($rendezvous);
            $em->flush();

            // On retourne le code
            return new Response('Ok', $code);
        }else{
            // Les données sont incomplètes
            return new Response('Données incomplètes', 404);
        }


        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
