<?php

declare(strict_types=1);

namespace App\Modules\Orders\Api\Actions;

use App\Entity\Orders;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetProductsOrderAction extends AbstractController
{
    public function __invoke(Orders $orders): JsonResponse
    {
        $products = new ArrayCollection();
        foreach ($orders->getOrderProducts() as $orderProduct) {
            $products->add($orderProduct->getProduct());
        }

        return $this->json($products);
    }
}
