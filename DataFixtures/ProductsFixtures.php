<?php

declare(strict_types=1);

namespace Root\DataFixtures;

use App\Entity\Products;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class ProductsFixtures extends Fixture
{
    public function __construct(
        private PasswordHasherFactoryInterface $passwordHasherFactory,
    ) {}

    public function load(ObjectManager $manager): void
    {
        $passwordHasher = $this->passwordHasherFactory->getPasswordHasher(User::class);
        $userAdmin = new User();
        $password = 'user';
        $password = $passwordHasher->hash($password);
        $userAdmin->setEmail('user@froots.com')
            ->setPassword($password)
            ->setRoles(['ROLE_USER'])
        ;
        $manager->persist($userAdmin);

        $generator = Factory::create('en_US');

        for ($i = 0; $i <= 100; ++$i) {
            $product = (new Products())
                ->setName($generator->name)
                ->setPrice($generator->randomFloat(2, 100, 900))
            ;
            $this->addReference(sprintf('reference_product_%s', $i), $product);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
