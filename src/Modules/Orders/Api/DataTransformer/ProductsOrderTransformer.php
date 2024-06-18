<?php

declare(strict_types=1);

namespace App\Modules\Orders\Api\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\Orders;
use App\Modules\Orders\Api\DTO\ProductsOrderOutput;
use Doctrine\Common\Collections\ArrayCollection;

class ProductsOrderTransformer implements DataTransformerInterface
{
    /**
     * @param mixed   $data
     * @param mixed[] $context
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return ProductsOrderOutput::class === $to && $data instanceof Orders;
    }

    /**
     * @param Orders  $object
     * @param mixed[] $context
     */
    public function transform($object, string $to, array $context = []): ProductsOrderOutput
    {
        $output = new ProductsOrderOutput();
        $products = new ArrayCollection();
        foreach ($object->getOrderProducts() as $orderProduct) {
            $products->add($orderProduct->getProduct());
        }
        $output->products = $products;

        return $output;
    }
}
