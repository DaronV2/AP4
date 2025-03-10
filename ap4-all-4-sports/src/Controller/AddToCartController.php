<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class AddToCartController extends AbstractController
{

    #[Route('/ajax/add', name: 'app_add_to_cart', methods: ['POST'])]
    public function index(Request $request, ProductsRepository $prodRepo)
    {
        $content = $request->getContent();
        $data = json_decode($content, true);

        // Vérifier que les données sont bien présentes
        if ($data['quantity'] == null && $data['idProduct'] == null) {
            return new JsonResponse(['error' => 'Données manquantes'], 400);
        }

        // Récupération des valeurs
        $quantity = (int) $data['quantity'];
        $idProduct = (int) $data['idProduct'];

        $session = $request->getSession();
        $cart = $session->get('cart');
        if (!is_array($cart)) {
            $cart = [];
        }
        if (isset($cart[$idProduct])) {
            // Décoder le produit existant
            $existingProduct = json_decode($cart[$idProduct], true);
            // Mettre à jour la quantité
            $existingProduct['quantity'] += $quantity;
            // Réencoder le produit mis à jour
            $cart[$idProduct] = json_encode($existingProduct);
        } else {
            // Ajouter le nouveau produit au panier
            $productObj = $prodRepo->findOneBy(['id' => $idProduct]);
            $cart[$idProduct] = json_encode(['product' => $productObj->toArray(), 'quantity' => $quantity]);
        }
        // Mettre à jour le panier dans la session
        $session->set('cart', $cart);

        // Simuler un traitement (ex: ajout au panier)
        $response = [
            'message' => "Produit ajouté avec succès",
            'quantity' => $quantity,
            'idProduct' => $idProduct
        ];

        return new JsonResponse($response, 200);
    }
}
