<?php 

namespace App\Controller\Admin;

use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/user', name:'admin_user_')]
class UserController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(UsersRepository $usersRepository): Response
    {
        $users = $usersRepository->findAll();

        return $this->render('admin/user/index.html.twig', compact('users'));
    }

    #[Route('/modification/{id}', name: 'edit')]
    public function edit(Users $users, Request $request, ManagerRegistry $managerRegistry): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', $users);
        $roles = json_encode($users->getRoles(), true);

        $userForm = $this->createForm(UsersType::class, $users);
        $userForm->handleRequest($request);
        
        if($userForm->isSubmitted()&&$userForm->isValid()){
            $em = $managerRegistry->getManager();
            $em->persist($users);
            $em->flush();

            $this->addFlash('message', 'Utilisateur modifié avec succès .');

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/edit.html.twig', [
            'form' => $userForm->createView(),
            'user' => $users,
            'roles' => $roles
        ]);
    }
}