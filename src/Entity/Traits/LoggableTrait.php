<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait LoggableTrait
{
    /**
     * @Doctrine\ORM\Mapping\Column(type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
     *
     * @\Gedmo\Mapping\Annotation\Timestampable(on="create")
     */
    #[Groups('read')]
    private \DateTimeImmutable $createdAt;

    /**
     * @Doctrine\ORM\Mapping\Column(type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
     *
     * @\Gedmo\Mapping\Annotation\Timestampable(on="update")
     */
    #[Groups('read')]
    private \DateTimeImmutable $updatedAt;

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = \DateTimeImmutable::createFromInterface($createdAt);

        return $this;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = \DateTimeImmutable::createFromInterface($updatedAt);

        return $this;
    }
}
