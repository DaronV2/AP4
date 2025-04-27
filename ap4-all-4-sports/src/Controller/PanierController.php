<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Products;
use App\Repository\ProductsRepository;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier_index')]
    public function index(SessionInterface $session, Request $request, SerializerInterface $serializer, ProductsRepository $prodrepo): Response
    {
        // Récupérer la session
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        // Initialiser un tableau pour stocker les produits
        $productsString = [];

        // Boucler sur les éléments du panier
      /*  foreach ($cart as $key => $item) {
            // Décoder le JSON stocké dans la valeur du tableau
            $decodedItem = json_decode($item, true); 

            // Vérifier si le produit est bien présent et l'ajouter au tableau
            if (isset($decodedItem['product'])) {
                // $decodedToObj = $serializer->deserialize($decodedItem['product'], Products::class, 'json');
                $decodedItem['product']['id'] = $key;
                $productsString[] = json_encode($decodedItem['product']); // Ajout avec un retour à la ligne
            }
        }
        $produitsObjet = [];
        // Debug pour voir les produits extraits
        foreach($productsString as $produit){
            $produitsObjet[] = $serializer->deserialize($produit, Products::class, 'json');
        }

        // dd($productsString);
        dd($serializer->serialize($prodrepo->findOneBy(['id' => 2]) ,'json'));
*/
        return $this->render('panier/panier.html.twig', [
            'products' => NULL
        ]);
    }
}
