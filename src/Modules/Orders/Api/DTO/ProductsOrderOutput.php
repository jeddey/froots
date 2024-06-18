<?php

declare(strict_types=1);

namespace App\Modules\Orders\Api\DTO;

use App\Entity\Products;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

class ProductsOrderOutput
{
    /**
     * @var Collection<int, Products> $products
     */
    #[Groups('read')]
    public Collection $products;
}
