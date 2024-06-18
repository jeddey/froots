<?php

declare(strict_types=1);

namespace Root\DataFixtures;

use App\Entity\OrderProducts;
use App\Entity\Orders;
use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OrderProductsFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            OrdersFixtures::class,
            ProductsFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $generator = Factory::create('en_US');

        for ($i = 0; $i <= 10; ++$i) {
            $randomProductCount = rand(1, 10);
            for ($j = 0; $j <= $randomProductCount; ++$j) {
                $orderProducts = new OrderProducts();

                $refOrder = sprintf('reference_order_%s', $i);

                /** @var Orders $order */
                $order = $this->getReference($refOrder);
                $orderProducts->setOrder($order);

                $refProduct = sprintf('reference_product_%s', $j);

                /** @var Products $product */
                $product = $this->getReference($refProduct);
                $orderProducts->setProduct($product);
                $orderProducts->setQuantity(rand(1, 7));
                $orderProducts->setPrice($generator->randomFloat(2, 100, 900));
                $manager->persist($orderProducts);
            }
        }

        $manager->flush();
    }
}
