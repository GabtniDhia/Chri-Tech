<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessageType;
use App\Repository\MessagesRepository;
use App\Repository\UserRepository;
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
     * @Route("/send/{id}", name="msg_send")
     */
    public function send($id,MessagesRepository $messages,Request $request, UserRepository $userrepo): Response
    {
        $message = new Messages();

        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $message->setRecipient($userrepo->findOneBy(['id' => $id]));
            $message->setSender($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

        }
        $me = $this->getUser();
        return $this->render('messages/send.html.twig', [
            'louled' => $messages->getids($me),
            'messages' => $messages->getmsgs($me,$id),
            'messForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/received", name="received")
     */
    public function received(Request $request, MessagesRepository $messages): Response
    {
        $me = $this->getUser();
        $message = new Messages();
        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $message->setSender($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('msg_send' , [
                'id' => $message->getRecipient()->getId()
            ]);
        }

        return $this->render("messages/received.html.twig", [
            'louled' => $messages->getids($me),
            'messForm' => $form->createView()
        ]);
    }
}
