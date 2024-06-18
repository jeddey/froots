<?php

declare(strict_types=1);

namespace App\Modules\Orders\Api\DoctrineExtension;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface as LegacyQueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;

class ProductsOrderExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    /**
     *  Here we can add extension to queryBuilder to a collection.
     */
    public function applyToCollection(QueryBuilder $queryBuilder, LegacyQueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?string $operationName = null): void {}

    /**
     * Here we can add extension to queryBuilder to a single item.
     *
     * @param mixed[] $identifiers
     * @param mixed[] $context
     */
    public function applyToItem(QueryBuilder $queryBuilder, LegacyQueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, ?string $operationName = null, array $context = []): void {}
}
