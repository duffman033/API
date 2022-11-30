<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ApiResource]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    #[Assert\NotBlank (message: "Le nom d'utilisateur est obligatoire")]
    #[Assert\Length (min: 1, max: 25, minMessage: "Le nom doit faire au moins {{limit}} caractères", maxMessage: "Le nom doit faire au maximum {{limit}} caractères")]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message: "L'email est obligatoire")]
    #[Assert\Length (min: 1, max: 255, minMessage: "L'email doit faire au moins {{limit}} caractères", maxMessage: "L'email doit faire au maximum {{limit}} caractères")]
    #[Assert\Email(message: "L'e-mail {{ value }} n'est pas un e-mail valide.")]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
