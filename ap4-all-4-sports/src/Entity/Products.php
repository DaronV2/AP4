<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use App\Repository\RayonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $price_ttc = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fournisseur $fournisseur = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rayon $rayon = null;

    /**
     * @var Collection<int, Pictures>
     */
    #[ORM\OneToMany(targetEntity: Pictures::class, mappedBy: 'id_produit')]
    private Collection $pictures;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\ManyToMany(targetEntity: Order::class, mappedBy: 'reference_product')]
    private Collection $orders;

    /**
     * @var Collection<int, Stocke>
     */
    #[ORM\OneToMany(targetEntity: Stocke::class, mappedBy: 'reference_product')]
    private Collection $stockes;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\Column(length: 255)]
    private ?string $code_product = null;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->stockes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriceTtc(): ?float
    {
        return $this->price_ttc;
    }

    public function setPriceTtc(float $price_ttc): static
    {
        $this->price_ttc = $price_ttc;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $id_fournisseur): static
    {
        $this->fournisseur = $id_fournisseur;
        return $this;
    }

    public function getRayon(): ?Rayon
    {
        return $this->rayon;
    }

    public function setRayon(?Rayon $id_rayon): static
    {
        $this->rayon = $id_rayon;

        return $this;
    }

    /**
     * @return Collection<int, Pictures>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Pictures $picture): static
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setIdProduit($this);
        }

        return $this;
    }

    public function removePicture(Pictures $picture): static
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getIdProduit() === $this) {
                $picture->setIdProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->addReferenceProduct($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            $order->removeReferenceProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Stocke>
     */
    public function getStockes(): Collection
    {
        return $this->stockes;
    }

    public function addStocke(Stocke $stocke): static
    {
        if (!$this->stockes->contains($stocke)) {
            $this->stockes->add($stocke);
            $stocke->setReferenceProduct($this);
        }

        return $this;
    }

    public function removeStocke(Stocke $stocke): static
    {
        if ($this->stockes->removeElement($stocke)) {
            // set the owning side to null (unless already changed)
            if ($stocke->getReferenceProduct() === $this) {
                $stocke->setReferenceProduct(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function toArray()
    {
        return
            [
                'id' => $this->getId(),
                'price_ttc' => $this->getPriceTtc(),
                'description' => $this->getDescription(),
                'fournisseur' => $this->getFournisseur(),
                'rayon' => $this->getRayon(),
                'pictures' => $this->getPictures(),
                'name' => $this->getName(),
                'rating' => $this->getRating()
            ];
    }

    public function getCodeProduct(): ?string
    {
        return $this->code_product;
    }

    public function setCodeProduct(string $code_product): static
    {
        $this->code_product = $code_product;

        return $this;
    }
}
