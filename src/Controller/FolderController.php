<?php

namespace App\Controller;

use App\Entity\Folder;
use App\Form\FolderType;
use App\Repository\FolderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/folder')]
class FolderController extends AbstractController
{
    #[Route('/new', name: 'app_folder_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $folder = new Folder();
        $form = $this->createForm(FolderType::class, $folder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $folder->setUser($this->getUser());
            $em->persist($folder);
            $em->flush();
            return $this->redirectToRoute('app_task_index');
        }

        return $this->render('folder/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_folder_show', methods: ['GET'])]
    public function show(Folder $folder, FolderRepository $folderRepository): Response
    {
        return $this->render('folder/show.html.twig', [
            'folder' => $folder,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_folder_delete', methods: ['POST'])]
    public function delete(Request $request, Folder $folder, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $folder->getId(), $request->request->get('_token'))) {
            $em->remove($folder);
            $em->flush();
        }
        return $this->redirectToRoute('app_task_index');
    }
}