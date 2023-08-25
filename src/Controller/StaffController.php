<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/staff', name: 'staff')]
class StaffController extends AbstractController
{
    #[Route('/', name: '_home')]
    public function index(UsersRepository $usersRepository): Response
    {
        $user = $usersRepository->findAll();

        return $this->render('staff/index.html.twig', [
            "users" => $user
        ]);
    }

    #[Route('/detailAccount/{id}', name:'_detailAccount')]
    public function detailAccount(int $id, UsersRepository $usersRepository): Response
    {
        $data = $usersRepository->find($id);

        return $this->render('/staff/details.html.twig', [
            "user" => $data
        ]
        );
    }

    #[Route('/promote/{id}', name:'_promote')]
    public function promotion()
    {
        return $this->render('promote.html.twig');
    }

    #[Route('/activeAccount/{id}', name: '_activeAccount')]
    public function activeAccount(Users $user, ManagerRegistry $managerRegistry): Response
    {
        $user->setIsValidAccount(true);
        $em = $managerRegistry->getManager();
        $em->persist($user);
        $em->flush();

        $this->addFlash('message', "Compte activé avec succés !");
        return $this->redirectToRoute('staff_home');
    }

    #[Route('/disableAccount/{id}', name: '_disableAccount')]
    public function disableAccount(Users $user, ManagerRegistry $managerRegistry): Response
    {
        $user->setIsValidAccount(false);
        $em = $managerRegistry->getManager();
        $em->persist($user);
        $em->flush();

        $this->addFlash('message', 'Compte désactivé avec succés !');
        return $this->redirectToRoute('staff_home');
    }

    #[Route('/promote{id}', name: '_promote')]
    public function promote(int $id, UsersRepository $usersRepository)
    {
        $data = $usersRepository->findBy($id);

        return $this->render('staff/promote.html.twig', [
            "user" => $data
        ]);
    }

    
}
