<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait NameTrait
{
    /**
     * @Doctrine\ORM\Mapping\Column(type="string_not_null", length=512)
     *
     * @\Gedmo\Mapping\Annotation\Versioned
     */
    #[Groups('read')]
    private string $name = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
