<?php

namespace App\DataFixtures;

use Aisle;
use App\Entity\Fournisseur;
use App\Entity\IsOrdered;
use App\Entity\Order;
use App\Entity\Pictures;
use App\Entity\Products;
use App\Entity\Rayon;
use App\Entity\Stocke;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Warehouse;
use DateTime;
use Modules;
use Status;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $admin->setPassword($this->hasher->hashPassword($admin, 'admin'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $listRayons = ['FootBall','BasketBall','Tennis','Golf'];
        $listRayonsObj = [];
        foreach ($listRayons as $rayonNom){
            $rayon = new Rayon();
            $rayon->setNom($rayonNom);
            $listRayonsObj[] = $rayon;
            $manager->persist($rayon);
        }

        $listFournisseur = ['Nike','Adidas','Puma','Decathlon'];
        $listFournisseurObj = [];
        foreach ($listFournisseur as $fournName){
            $fourni = new Fournisseur();
            $fourni->setNom($fournName);
            $listFournisseurObj[] = $fourni;
            $manager->persist($fourni);
        }

        $produit = new Products();
        $produit->setName('Ballon de foot');
        $produit->setPriceTtc(19.99);
        $produit->setRayon($listRayonsObj[0]);
        $produit->setFournisseur($listFournisseurObj[0]);
        $produit->setDescription('Ballon de foot taille 5');
        $produit->setRating(5);
        $manager->persist($produit);
        $pic = new Pictures();
        $pic->setUrl('https://pim.decapro.com/MEDIA/MEDIA/LARGE/1da/1da8d14b-0f55-4205-8994-ad663edb2e12.png');
        $pic->setIdProduit($produit);
        $manager->persist($pic);

        $produitTwo = new Products();
        $produitTwo->setName('Balle de tennis');
        $produitTwo->setPriceTtc(5.99);
        $produitTwo->setRayon($listRayonsObj[2]);
        $produitTwo->setFournisseur($listFournisseurObj[1]);
        $produitTwo->setDescription('Ballon de tennis taille 32 cm de diamètre');
        $produitTwo->setRating(4);
        $manager->persist($produitTwo);
        $picTwo = new Pictures();
        $picTwo->setUrl('https://contents.mediadecathlon.com/p2430275/k$1e8d3c7513161416388576796c87a0f3/sq/balles-de-tennis-australian-open4-jaune-polyvalente.jpg?format=auto&f=800x0');
        $picTwo->setIdProduit($produitTwo);
        $manager->persist($picTwo);

        $listEntrepots = ["Valenciennes","Paris"];
        $listEntrepotsObj = [];
        foreach ($listEntrepots as $entrepot){
            $ware = new Warehouse();
            $ware->setCity($entrepot);
            $listEntrepotsObj[] = $ware;
            $manager->persist($ware);
        }

        $stock = new Stocke();
        $stock->setReferenceProduct($produit);
        $stock->setIdWarehouse($listEntrepotsObj[0]);
        $stock->setModule(Modules::M1->value);
        $stock->setAislse(Aisle::E->value);
        $stock->setRowWarehouse("12");
        $stock->setSection("8");
        $manager->persist($stock);

        $order = new Order();
        $order->setDateOrder(new DateTime());
        $prods = [$produit, $produitTwo];
        $totalPrice = 0.0;
        foreach($prods as $prod){
            $order->addReferenceProduct($prod);
            $totalPrice =+ $prod->getPriceTtc();
        }
        $order->setTotalPrice($totalPrice);
        $order->setEmailClient($admin->getEmail());
        $order->setStatus(Status::expediated->value);
        $manager->persist($order);

        foreach($prods as $prod){
            $commande = new IsOrdered();
            $commande->setCommand($order);
            $commande->setProduct($prod);
            $commande->setQuantity(20);
            $manager->persist($commande);
        }    


        $manager->flush();
    }
}
