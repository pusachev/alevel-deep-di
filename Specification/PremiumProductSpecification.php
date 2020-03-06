<?php


namespace ALevel\DeepDi\Specification;


use Magento\Catalog\Api\Data\ProductInterface;

class PremiumProductSpecification implements SpecificationInterface
{
    const ATTRIBUTE_NAME = 'is_premium';

    public function isSatisfiedBy(ProductInterface $product): bool
    {
        return (bool) $product->getData(self::ATTRIBUTE_NAME);
    }
}