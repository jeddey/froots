<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entites;

use App\Entity\Products as ProductsEntity;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class ProductsTest extends KernelTestCase
{
    protected ProductsEntity $products;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->products = new ProductsEntity();
    }

    public function testGetterAndSetter(): void
    {
        self::assertNull($this->products->getId());
        $name = 'name';
        $price = 100;
        $date = \DateTimeImmutable::createFromMutable(new \DateTime());
        $this->products->setName($name);
        $this->products->setPrice($price);
        $this->products->setCreatedAt($date);
        $this->products->setUpdatedAt($date);
        self::assertEquals($date, $this->products->getCreatedAt());
        self::assertEquals($date, $this->products->getUpdatedAt());
        self::assertEquals($name, $this->products->getName());
        self::assertEquals($price, $this->products->getPrice());
    }
}
