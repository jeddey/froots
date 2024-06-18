<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entites;

use App\Entity\OrderProducts;
use App\Entity\Orders;
use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class OrdersTest extends KernelTestCase
{
    protected Orders $orders;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->orders = new Orders();
    }

    public function testGetterAndSetter(): void
    {
        self::assertNull($this->orders->getId());
        $price = 100;
        $date = \DateTimeImmutable::createFromMutable(new \DateTime());
        $this->orders->setAmount($price);
        $this->orders->setCreatedAt($date);
        $this->orders->setUpdatedAt($date);
        self::assertEquals($date, $this->orders->getCreatedAt());
        self::assertEquals($date, $this->orders->getUpdatedAt());
        self::assertEquals($price, $this->orders->getAmount());

        $product = new Products();
        $product->setName('test');

        $ordersProduct = new OrderProducts();
        $ordersProduct->setProduct($product);
        $ordersProduct->setOrder($this->orders);
        $this->orders->addOrderProduct($ordersProduct);
        self::assertNotEmpty($this->orders->getOrderProducts());
        self::assertEquals($ordersProduct, $this->orders->getOrderProducts()->first());
        $this->orders->removeOrderProduct($ordersProduct);
        self::assertEmpty($this->orders->getOrderProducts());
    }
}
