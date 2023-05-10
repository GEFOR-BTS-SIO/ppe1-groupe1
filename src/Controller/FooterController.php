<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FooterController extends AbstractController
{
    #[Route('/rgpd', name: 'app_rgpd')]
    public function rgpd(): Response
    {
       return $this->render('./footer/rgpd.html.twig');
        }
    }