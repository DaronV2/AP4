<?php
namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface as SerializerSerializerInterface;

class PanierController extends AbstractController
{
    #[Route('/cart', name: 'panier_index')]
    public function index(SessionInterface $session, ProductsRepository $prodRepo): Response
    {
            $panier = $session->get('cart');
        $products = [];
        $quantity = [];
        $totalPanier = 0.0;
        if($panier){
            foreach($panier as $key => $value){
                $product = $prodRepo->findBy(['id' => $key]);
                $products[] = $product[0];
                $idProduct = $product[0]->getId();
                // dump($product[0]->getPrice_Ttc() * floatval($value));
                $valueJson = json_decode($value);
                $totalPanier += floatval($product[0]->getPrice_Ttc()) * floatval($valueJson->quantity);
                $quantity[$idProduct] = intval($valueJson->quantity);
            }
        }
        // dd($panier); 
        return $this->render('panier/panier.html.twig', [
            'panier' => $panier,
            'products' => $products,
            'quantities' => $quantity,
            'totalCart' => $totalPanier
        ]);
    }

    #[Route('/clearCart', name: 'panier_clear')]
    public function clear(SessionInterface $session)
    {
        $panier = $session->get('cart');
        $panier = [];
        $session->set('cart', $panier);

        return $this->redirectToRoute('app_home');
    }

    #[Route('/cart/removeCart', name: 'panier_clear', methods: ['POST'])]
    public function remove(Request $request, SessionInterface $session)
    {
        $content = $request->getContent();
        $data = json_decode($content, true);
        if(! isset($data['id'])){
            return new JsonResponse(['error' => 'Données manquantes'], 400);
        }
        $cart = $session->get('cart');
        unset($cart[$data['id']]);
        $session->set('cart', $cart);
        $this->redirectToRoute('panier_index');

        return new JsonResponse($request, 200);
    }
}
