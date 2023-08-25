<?php 

namespace App\Controller\Admin;

use App\Repository\JobGradesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

#[Route('/admin/jobgrade', name:'admin_jobgrade_')]
class JobgradeController extends AbstractController
{
    #[Route('/', name:'index')]
    public function index(JobGradesRepository $jobGradesRepository): Response
    {
        $jobgrades = $jobGradesRepository->findAll();

        return $this->render('admin/jobgrade/index.html.twig', compact('jobgrades'));
    }
}