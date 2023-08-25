<?php 

namespace App\Controller\Admin;

use App\Repository\UsersRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

#[Route('/admin/user', name:'admin_user_')]
class UserController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(UsersRepository $usersRepository): Response
    {
        $users = $usersRepository->findAll();

        return $this->render('admin/user/index.html.twig', compact('users'));
    }
}