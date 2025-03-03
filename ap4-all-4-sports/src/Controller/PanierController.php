<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier_index')]
    public function index(SessionInterface $session): Response
    {
        $panier = $session->get('panier', ['items' => [], 'total' => 0]);

        return $this->render('panier/panier.html.twig', [
            'panier' => $panier
        ]);
    }
}
