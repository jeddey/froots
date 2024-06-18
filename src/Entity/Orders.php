<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Interfaces\IdInterface;
use App\Entity\Interfaces\LoggableInterface;
use App\Entity\Traits\IdTrait;
use App\Entity\Traits\LoggableTrait;
use App\Modules\Orders\Api\Actions\GetProductsOrderAction;
use App\Modules\Orders\Api\DTO\ProductsOrderOutput;
use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        'GET' => ['normalization_context' => ['groups' => ['read', 'orders:read']]],
    ],
    itemOperations: [
        'products' => [
            'method' => 'GET',
            'path' => '/orders/{id}/products',
            'requirements' => ['id' => '\d+'],
            //            'controller' => GetProductsOrderAction::class, // second approach
        ],
    ],
    output: ProductsOrderOutput::class,
)]
class Orders implements IdInterface, LoggableInterface
{
    use IdTrait;
    use LoggableTrait;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    #[Groups('orders:read')]
    private float $amount;

    /**
     * @var Collection<int, OrderProducts>
     *
     * @ORM\OneToMany(targetEntity="OrderProducts", mappedBy="order")
     */
    private Collection $orderProducts;

    public function __construct()
    {
        $this->orderProducts = new ArrayCollection();
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return Collection<int, OrderProducts>
     */
    public function getOrderProducts(): Collection
    {
        return $this->orderProducts;
    }

    public function addOrderProduct(OrderProducts $orderProduct): self
    {
        if (!$this->orderProducts->contains($orderProduct)) {
            $this->orderProducts[] = $orderProduct;
            $orderProduct->setOrder($this);
        }

        return $this;
    }

    public function removeOrderProduct(OrderProducts $orderProduct): self
    {
        $this->orderProducts->removeElement($orderProduct);

        return $this;
    }
}
