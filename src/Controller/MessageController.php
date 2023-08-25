<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessagesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/message', name: 'message')]
class MessageController extends AbstractController
{
    #[Route('/', name: '_home')]
    public function index(): Response
    {
        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
        ]);
    }

    // Page d'evnoie de nouveau message //
    #[Route('/send', name: '_send')]
    public function send(Request $request, ManagerRegistry $managerRegistry) :Response
    {

        $message = new Messages;
        $form = $this->createForm(MessagesType::class, $message);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $message->setSender($this->getUser());

            $em = $managerRegistry->getManager();
            $em->persist($message);
            $em->flush();

            $this->addFlash("message", "Message envoyé avec succès;");
            return $this->redirectToRoute("message_home");
        }

        return $this->render("message/send.html.twig", [
            "form" => $form->createView()
        ]);
    }

    // Page de reception des messages //
    #[Route('/received', name: '_received')]
    public function received(): Response
    {
        return $this-> render('message/received.html.twig');
    }


    // Page de lecture d'un message //
    #[Route('/read/{id}', name: '_read')]
    public function read(Messages $message, ManagerRegistry $managerRegistry): Response
    {
        $message->setIsRead(true);
        $em = $managerRegistry->getManager();
        $em->persist($message);
        $em->flush();

        return $this->render('message/read.html.twig', compact ('message'));
    }

    #[Route('/confirmArchive/{id}', name: '_confirmArchive')]
    public function confirmArchive(Messages $message): Response
    {
        return $this->render('message/confirmArchive.html.twig', [
            'message'=> $message
        ]
    );
    }

    // Page de la boite d'envoi //
    #[Route('/sent', name: '_sent')]
    public function sent(): Response
    {
        return $this->render('message/sent.html.twig');
    }

    // Méthode d'envoi a la corbeille
    #[Route('/archived/{id}', name: '_archived')]
    public function archived(Messages $message, ManagerRegistry $managerRegistry): Response
    {
        $message->setIsArchived(true);
        $em = $managerRegistry->getManager();
        $em->persist($message);
        $em->flush();

        $this->addFlash("message", "Message déplacé avec succès;");
        return $this->redirectToRoute("message_received");

    }

    // Page corbeille de la messagerie
    #[Route('/garbage', name: '_garbage')]
    public function garbage(): Response
    {
        return $this->render('message/garbage.html.twig');
    }


    #[Route('/confirmDelete/{id}', name: '_confirmDelete')]
    public function confirmDelete(Messages $message)
    {
        return $this->render('message/confirmDelete.html.twig', [
            'message'=> $message
        ]);
    }

    // Méthode de suppression des messages //
    #[Route('/delete/{id}', name: '_delete')]
    public function delete(Messages $messages, ManagerRegistry $managerRegistry): Response
    {
        $em = $managerRegistry->getManager();
        $em->remove($messages);
        $em->flush();

        $this->addFlash("message", "Message supprimé avec succès;");
        return $this->redirectToRoute("message_received");
    }
}
