<?php

namespace App\Controller;

use App\Entity\Priority;
use App\Repository\PriorityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/priority')]
final class PriorityController extends AbstractController
{
    #[Route(name: 'app_priority_index', methods: ['GET'])]
    public function index(PriorityRepository $priorityRepository): Response
    {
        return $this->render('priority/index.html.twig', [
            'priorities' => $priorityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_priority_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $priority = new Priority();

        if ($request->isMethod('POST')) {
            $priority->setLevel($request->request->get('level'));
            $entityManager->persist($priority);
            $entityManager->flush();
            return $this->redirectToRoute('app_priority_index');
        }

        return $this->render('priority/new.html.twig', [
            'priority' => $priority,
        ]);
    }
}