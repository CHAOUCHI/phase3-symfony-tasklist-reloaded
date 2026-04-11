<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\User;
use App\Enum\TaskStatus;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('/task')]
final class TaskController extends AbstractController
{
    // #[Route(name: 'app_task_index', methods: ['GET'])]
    // public function index(TaskRepository $taskRepository): Response
    // {
    //     return $this->render('task/index.html.twig', [
    //         'tasks' => $taskRepository->findAll(),
    //     ]);
    // }

    #[Route('/new', name: 'app_task_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, #[CurrentUser()] User $user): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setUser($user);
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('task/new.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/done',name:"app_task_done",methods:['POST'])]
    public function validateTask(Task $task, #[CurrentUser()] User $user, EntityManagerInterface $entityManager):Response
    {
        if($task->getUser()->getId() != $user->getId()){
            return $this->redirectToRoute('app_dashboard',[],Response::HTTP_UNAUTHORIZED);
        }
        // !! missing CSRF protection !!

        if($task->getStatus() == TaskStatus::completed){
            $task->setStatus(TaskStatus::pending);
        }else if($task->getStatus() == TaskStatus::pending){
            $task->setStatus(TaskStatus::completed);
        }
        // No need to call this->persist since the task is already managed 
        // by Doctrine automaticamlly when we fetch it from the database on the paramter of this method 
        $entityManager->flush();

        return $this->redirectToRoute('app_dashboard',[],Response::HTTP_SEE_OTHER);
    }

    // #[Route('/{id}', name: 'app_task_show', methods: ['GET'])]
    // public function show(Task $task): Response
    // {
    //     return $this->render('task/show.html.twig', [
    //         'task' => $task,
    //     ]);
    // }

    // #[Route('/{id}/edit', name: 'app_task_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(TaskType::class, $task);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('task/edit.html.twig', [
    //         'task' => $task,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_task_delete', methods: ['POST'])]
    // public function delete(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$task->getId(), $request->getPayload()->getString('_token'))) {
    //         $entityManager->remove($task);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
    // }
}
