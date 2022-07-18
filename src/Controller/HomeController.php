<?php

namespace App\Controller;

use App\Class\Search;
use App\Entity\Product;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $entityManager;

    public function __construct( EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('', name: 'home')]
    public function index( HttpFoundationRequest $request): Response
    {   
        $products = $this->entityManager->getRepository(Product::class)->findAll();
        $disponibility = false;

        $search = new Search();
        $form = $this->createForm(SearchType::class,$search);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $products = $this->entityManager->getRepository(Product::class)->findwithSearch($search);
        }
    
        return $this->render('home/index.html.twig', [
            'products'=>$products,
            'dispo'=> $disponibility,
            'form'=>$form->createView()
        ]);
    }
}
