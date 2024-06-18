<?php

declare(strict_types=1);

namespace App\Entity\Interfaces;

interface LoggableInterface
{
    public function getCreatedAt(): \DateTimeImmutable;

    public function getUpdatedAt(): ?\DateTimeImmutable;
}
