<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Interfaces\IdInterface;
use App\Entity\Interfaces\LoggableInterface;
use App\Entity\Traits\IdTrait;
use App\Entity\Traits\LoggableTrait;
use App\Repository\OrderProductsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderProductsRepository::class)
 */
class OrderProducts implements IdInterface, LoggableInterface
{
    use IdTrait;
    use LoggableTrait;

    /**
     * @ORM\Column(type="integer")
     */
    private int $quantity;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private float $price;

    /**
     * @ORM\ManyToOne(targetEntity="Orders", inversedBy="orderProducts")
     *
     * @ORM\JoinColumn(nullable=false)
     */
    private Orders $order;

    /**
     * @ORM\ManyToOne(targetEntity="Products")
     *
     * @ORM\JoinColumn(nullable=false)
     */
    private Products $product;

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getOrder(): Orders
    {
        return $this->order;
    }

    public function setOrder(Orders $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function getProduct(): Products
    {
        return $this->product;
    }

    public function setProduct(Products $product): self
    {
        $this->product = $product;

        return $this;
    }
}
