<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use App\Repository\RayonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HeaderController extends AbstractController
{
    #[Route(name: 'app_header')]
    public function index(RayonRepository $rayonRepo): Response
    {
        $rayons = $rayonRepo->findAll();
        return $this->render('header/header.html.twig', [
            'rayons' => $rayons,
        ]);
    }

    #[Route('/search', name: 'app_search')]
public function search(Request $request, ProductsRepository $productsRepository): Response
{
    $query = $request->query->get('q', '');

    if ($query) {
        $produits = $productsRepository->recherche($query);
    } else {
        $produits = [];
    }

    return $this->render('header/search_results.html.twig', [
        'produits' => $produits,
        'query' => $query,
    ]);
    
    
}

}
