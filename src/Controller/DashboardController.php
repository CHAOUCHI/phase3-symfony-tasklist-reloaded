<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack;

final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(TaskRepository $taskRepo): Response
    {
        $tasks = $taskRepo->findAll();
        return $this->render('dashboard/index.html.twig', [
            'tasks' => $tasks
        ]);
    }

    #[Route('/', name: 'app_home')]
    public function home(): Response{

        return $this->redirectToRoute('app_dashboard');
    }
}
