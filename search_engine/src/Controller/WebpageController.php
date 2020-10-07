<?php

namespace App\Controller;

use App\Entity\Webpage;
use App\Form\WebpageType;
use App\Repository\WebpageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/webpage")
 */
class WebpageController extends AbstractController
{

    /**
     * @Route("/{id}", name="webpage_show", methods={"GET"})
     */
    public function show(Webpage $webpage): Response
    {
        return $this->render('webpage/show.html.twig', [
            'webpage' => $webpage,
        ]);
    }

}
