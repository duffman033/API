<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Product;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        //Création d'un Client
        $client = new Client;
        $client
            ->setEmail("client@bilemo.com")
            ->setRoles(["ROLE_USER"])
            ->setPassword($this->userPasswordHasher->hashPassword($client, "password"));
        $manager->persist($client);

        // Création des utilisateurs
        for ($i = 0; $i < 20; $i++) {
            $users = new Users;
            $users->setUsername('UserName ' . $i);
            $users->setEmail('email ' . $i.'@gmail.com');
            $manager->persist($users);
        }

        // Création des produits
        for ($i = 0; $i < 20; $i++) {
            $produit = new Product;
            $produit
                ->setName('Produit ' . $i)
                ->setDescription('Description du produit numéro : ' . $i)
                ->setPrice(random_int(10, 100))
                ->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($produit);
        }

        $manager->flush();
    }
}
