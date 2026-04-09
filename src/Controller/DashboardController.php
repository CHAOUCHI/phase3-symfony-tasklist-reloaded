<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\Entity\User;
use App\Repository\PriorityRepository;

final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(#[CurrentUser] User $user, PriorityRepository $priorityRepository): Response
    {
        $tasks = $user->getTasks(); # Get user's tasks only not all tasks in the database
        $priorities = $priorityRepository->findAll(); # Get all priorities to display them in the dashboard filtering form
        return $this->render('dashboard/index.html.twig', [
            'tasks' => $tasks,
            'priorities' => $priorities,
        ]);
    }

    #[Route('/', name: 'app_home')]
    public function home(): Response{

        return $this->redirectToRoute('app_dashboard');
    }
}
