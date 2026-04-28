<?php

namespace App\Controller;

use App\Repository\FolderRepository;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;   


final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(Request $request, TaskRepository $taskRepository, FolderRepository $folderRepository): Response
    {
        $status   = $request->query->get('status');
        $priority = $request->query->get('priority');

        $folders = $folderRepository->findAll();
        $taskCounts = [];
        foreach ($folders as $folder) {
            $taskCounts[$folder->getId()] = $taskRepository->countByFolder($folder);
        }

        return $this->render('home/index.html.twig', [
            'tasks'      => $taskRepository->findByFilters($status, $priority),
            'folders'    => $folders,
            'taskCounts' => $taskCounts,
        ]);
    }
}
