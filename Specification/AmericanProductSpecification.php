<?php


namespace ALevel\DeepDi\Specification;

use Magento\Catalog\Api\Data\ProductInterface;

class AmericanProductSpecification implements SpecificationInterface
{
    const ATTRIBUTE_NAME = 'sale';

    public function isSatisfiedBy(ProductInterface $product): bool
    {
        return (bool)$product->getData(self::ATTRIBUTE_NAME) ;
    }
}
