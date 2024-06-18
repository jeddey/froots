<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Interfaces\IdInterface;
use App\Entity\Interfaces\LoggableInterface;
use App\Entity\Traits\IdTrait;
use App\Entity\Traits\LoggableTrait;
use App\Repository\ProductsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        'GET' => ['normalization_context' => ['groups' => ['read', 'products:read']]],
    ],
    itemOperations: ['GET']
)]
class Products implements IdInterface, LoggableInterface
{
    use IdTrait;
    use LoggableTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups('products:read')]
    private string $name;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private float $price;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
}
