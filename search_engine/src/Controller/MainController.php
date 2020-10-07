<?php

namespace App\Controller;

use App\Form\SearchInputType;
use App\Repository\SearcherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(Request $request, SearcherRepository $searcherRepository)
    {
        $form = $this->createForm(SearchInputType::class);
        $form->handleRequest($request);
        $webpages = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $user_input = $form->get('palabra')->getData();
            $limite = $form->get('limite')->getData();
            $palabras = explode(' ', $user_input);
            $webpages = $searcherRepository->getSearchResults($palabras, $limite);
        }
        return $this->render('main/index.html.twig', [
            'form' => $form->createView(),
            'webpages' =>  $webpages,
        ]);
    }
}
