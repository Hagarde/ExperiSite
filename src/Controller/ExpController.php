<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExpController extends AbstractController
{
    /**
     * @Route("/exp", name="exp")
     */
    public function index(): Response
    {
        return $this->render('exp/index.html.twig', [
            'controller_name' => 'ExpController',
        ]);
    }
}
