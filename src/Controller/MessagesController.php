<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessageType;
use App\Repository\MessagesRepository;
use Doctrine\Persistence\ObjectManager;
use http\Message;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagesController extends AbstractController
{
    /**
     * @Route("/messages", name="messages")
     */
    public function index(): Response
    {
        return $this->render('messages/index.html.twig', [
            'controller_name' => 'MessagesController',
        ]);
    }
    /**
     * @Route("/send", name="send")
     */
    public function send(Request $request): Response
    {
        $message = new Messages();
        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $message->setSender($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            $this->addFlash('message', "Message Envoye ☻");
            $this->redirectToRoute('messages');
        }

        return $this->render('messages/send.html.twig', [
            'messForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/received", name="received")
     */
    public function received(MessagesRepository $messages): Response
    {
        $me = $this->getUser();
        return $this->render("messages/received.html.twig", [
            'louled' => $messages->getids($me)
        ]);


    }

    /**
     * @Route("/{id}/read", name="msg_read")
     */
    public function read($id,MessagesRepository $messages): Response
    {
        $me = $this->getUser();
        return $this->render("messages/read.html.twig", [
            'louled' => $messages->getids($me),
            'messages' => $messages->getmsgs($me,$id)
        ]);
    }
}
