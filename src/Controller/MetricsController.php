<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MetricsController extends AbstractController
{
    /**
     * Class to show metrics
     */


    /**
     * @Route("/metrics/",
     *      name="metrics"
     * )
     */
    public function index(): Response
    {
        return $this->render('metrics/index.html.twig', [
            'controller_name' => 'Metrics',
        ]);
    }
}
