<?php 

namespace App\Controller\Admin;

use App\Entity\JobGrades;
use App\Form\JobGradesType;
use App\Repository\JobGradesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/ajout', name:'add')]
    public function add(ManagerRegistry $managerRegistry, Request $request): Response
    {
        $jobgrades = new JobGrades;
        $form = $this->createForm(JobGradesType::class, $jobgrades);

        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            $em = $managerRegistry->getManager();
            $em->persist($jobgrades);
            $em->flush();

            $this->addFlash("message", "Grade ajouté avec succès .");
            return $this->redirectToRoute('admin_jobgrade_index');            
        }

        return $this->render('admin/jobgrade/add.html.twig', [
            "form" => $form->createView()
        ]);

    }

    #[Route('/modification/{id}', name: 'edit')]
    public function edit(JobGrades $jobGrades, Request $request, ManagerRegistry $managerRegistry): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', $jobGrades);

        $jobGradeForm = $this->createForm(JobGradesType::class, $jobGrades);
        $jobGradeForm-> handleRequest($request);

        if($jobGradeForm->isSubmitted()&&$jobGradeForm->isValid()){
            $em = $managerRegistry->getManager();
            $em->persist($jobGrades);
            $em->flush();

            $this->addFlash('message', 'Grade modifié avec succès .');

            return $this->redirectToRoute('admin_jobgrade_index');
        }

        return $this->render('admin/jobgrade/edit.html.twig', [
            'form' => $jobGradeForm->createView(),
            'jobgrades' => $jobGrades
        ]);
    }

    #[Route('/supprimer/{id}', name: 'delete')]
    public function delete(JobGrades $jobGrades, ManagerRegistry $managerRegistry): Response
    {
        $em = $managerRegistry->getManager();
        $em->remove($jobGrades);
        $em->flush();

        return $this->redirectToRoute("admin_jobgrade_index");
    }
}