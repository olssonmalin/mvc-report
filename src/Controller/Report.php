<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Report extends AbstractController
{
    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        $title = 'Om';

        return $this->render('about.html.twig', [
            'title' => $title
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function welcome(): Response
    {
        $title = 'Välkommen!';
        return $this->render('home.html.twig', [
            'title' => $title,
        ]);
    }

    /**
     * @Route("/report", name="report")
     */
    public function report(): Response
    {
        $title = 'Redovisningstexter';
        $path    = './../templates/texts/';
        $files = array_diff(scandir($path), array('.', '..'));

        return $this->render('report.html.twig', [
            'title' => $title,
            'files' => $files
            ]);
    }
}
