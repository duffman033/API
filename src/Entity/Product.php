<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
        operations: [
        new Get(),
        new GetCollection(),
    ],
    cacheHeaders: [
        'max_age' => 60,
        'shared_max_age' => 120,
        'vary' => ['Authorization', 'Accept-Language']
    ]
)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank (message: "Le nom du produit est obligatoire")]
    #[Assert\Length (min: 1, max: 255, minMessage: "Le nom doit faire au moins {{limit}} caractères", maxMessage: "Le nom doit faire au maximum {{limit}} caractères")]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Assert\NotBlank (message: "La description du produit est obligatoire")]
    #[Assert\Length (min: 1, minMessage: "La description doit faire au moins {{limit}} caractères")]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[Assert\NotBlank (message: "Le prix du produit est obligatoire")]
    #[Assert\Positive (message: "Le prix du produit est obligatoirement positif")]
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
