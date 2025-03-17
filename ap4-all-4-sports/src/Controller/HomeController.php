<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use App\Repository\RayonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ProductsRepository $prodRepo): Response
    {
        $produits = $prodRepo->findAll();
        return $this->render('home/index.html.twig', [
            'produits' => $produits,
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home/rayon/{id}', name: 'app_homepage')]
    public function indexRayon(ProductsRepository $prodRepo, RayonRepository $rayonRepo, int $id): Response
    {
        $produits = $prodRepo->findBy(['rayon' => $id]);
        $rayon = $rayonRepo->findOneBy(['id' => $id]);
        $rayonName = $rayon->getNom();
        return $this->render('home/index.html.twig', [
            'produits' => $produits,
            'displayMessage' => "Recherche pour le rayon : \"". $rayonName."\"",
            'controller_name' => 'HomeController',
        ]);
    }
}
