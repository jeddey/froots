<?php

declare(strict_types=1);

namespace App\Swagger;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SwaggerDecorator implements NormalizerInterface
{
    /**
     * @param array<string> $excludedApiEndpoints
     */
    public function __construct(
        private readonly NormalizerInterface $decorated,
        private readonly array $excludedApiEndpoints,
    ) {}

    public function supportsNormalization($data, ?string $format = null): bool
    {
        return $this->decorated->supportsNormalization($data, $format);
    }

    public function normalize($object, ?string $format = null, array $context = [])
    {
        $docs = $this->decorated->normalize($object, $format, $context);
        foreach ($this->excludedApiEndpoints as $uri) {
            unset($docs['paths'][$uri]);
        }

        return $docs;
    }
}
