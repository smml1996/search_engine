<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DatasetController extends AbstractController
{
    /**
     * @Route("/dataset", name="dataset")
     */
    public function index()
    {
        return $this->render('dataset/index.html.twig', [
            'controller_name' => 'Dataset',
        ]);
    }
}
