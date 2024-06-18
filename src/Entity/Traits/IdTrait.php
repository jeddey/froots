<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation\Groups;

trait IdTrait
{
    /**
     * @Doctrine\ORM\Mapping\Id
     *
     * @Doctrine\ORM\Mapping\GeneratedValue(strategy="IDENTITY")
     *
     * @Doctrine\ORM\Mapping\Column(type="integer")
     *
     * @ApiProperty(identifier=true)
     */
    #[Groups('read')]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }
}
