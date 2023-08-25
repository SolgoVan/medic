<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\EndService;
use App\Entity\StartService;
use App\Entity\TotalService;
use App\Repository\TotalServiceRepository;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/service', name: 'service_')]
class ServiceController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(TotalServiceRepository $totalServiceRepository): Response
    {
        $totalSumPerUser = $totalServiceRepository->getTotalSumPerUser();

        return $this->render('service/index.html.twig', [
            "totalSumPerUser" => $totalSumPerUser
        ]);
    }

    #[Route('/working/{id}', name: 'working')]
    public function toWorking(Users $user, ManagerRegistry $managerRegistry): Response
    {
        $user->setIsWorking(true);

        $startService = new StartService();
        $startService->setUser($this->getUser());
        $startService->setTimer(new \DateTime());
        $em = $managerRegistry->getManager();
        $em->persist($user);
        $em->persist($startService);
        $em->flush();

        return $this->render('main/index.html.twig');
    }

    #[Route('/enOfWork/{id}', name: 'endOfWork')]
    public function notWorking(Users $user, ManagerRegistry $managerRegistry): Response
    {
        $user->setIsWorking(false);
        $em = $managerRegistry->getManager();

        $user = $this->getUser();
        $startService = $em->getRepository(StartService::class)->findOneBy(['user' => $user], ['timer' => 'DESC']);

        if($startService){
            $endService = new EndService();
            $endService->setUser($user);
            $endService->setStart($startService);
            $endService->setTimer(new \DateTime());
            $em->persist($endService);
            $em->flush();

            $totalDuration = $endService->getTimer()->getTimestamp() - $startService->getTimer()->getTimestamp();

            $totalService = new TotalService();
            $totalService->setUser($user);
            $totalService->setStart($startService);
            $totalService->setEnd($endService);
            $totalService->setTotal($totalDuration);

            $em->persist($totalService);
            $em->flush();
        }

        $em->persist($user);
        $em->flush();

        return $this->render('main/index.html.twig');
    }
}
