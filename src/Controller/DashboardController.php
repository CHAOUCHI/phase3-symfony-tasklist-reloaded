<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack;

final class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    public function index(RequestStack $requestStack, LoggerInterface $logger): Response
    {
        $session = $requestStack->getSession();
        $session_array = $session->all();
        $logger->info("Session data:");
        foreach($session_array as $key => $value){
            $logger->info(sprintf("Session key: %s, Session value: %s", $key, $value));
        }

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
