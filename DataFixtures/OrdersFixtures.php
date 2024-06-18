<?php

declare(strict_types=1);

namespace Root\DataFixtures;

use App\Entity\Orders;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OrdersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $generator = Factory::create('en_US');

        for ($i = 0; $i <= 30; ++$i) {
            $order = new Orders();
            $order->setAmount($generator->randomFloat(2, 100, 900));
            $manager->persist($order);
            $this->addReference(sprintf('reference_order_%s', $i), $order);
        }

        $manager->flush();
    }
}
