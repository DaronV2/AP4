<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_order = null;

    #[ORM\Column]
    private ?float $total_price = null;

    /**
     * @var Collection<int, Products>
     */
    #[ORM\ManyToMany(targetEntity: Products::class, inversedBy: 'orders')]
    private Collection $reference_product;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $email_client = null;

    public function __construct()
    {
        $this->reference_product = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOrder(): ?\DateTimeInterface
    {
        return $this->date_order;
    }

    public function setDateOrder(\DateTimeInterface $date_order): static
    {
        $this->date_order = $date_order;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->total_price;
    }

    public function setTotalPrice(float $total_price): static
    {
        $this->total_price = $total_price;

        return $this;
    }

    /**
     * @return Collection<int, Products>
     */
    public function getReferenceProduct(): Collection
    {
        return $this->reference_product;
    }

    public function addReferenceProduct(Products $referenceProduct): static
    {
        if (!$this->reference_product->contains($referenceProduct)) {
            $this->reference_product->add($referenceProduct);
        }

        return $this;
    }

    public function removeReferenceProduct(Products $referenceProduct): static
    {
        $this->reference_product->removeElement($referenceProduct);

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getEmailClient(): ?User
    {
        return $this->email_client;
    }

    public function setEmailClient(?User $email_client): static
    {
        $this->email_client = $email_client;

        return $this;
    }
}
