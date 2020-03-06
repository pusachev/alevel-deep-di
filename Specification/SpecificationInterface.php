<?php


namespace ALevel\DeepDi\Specification;

use Magento\Catalog\Api\Data\ProductInterface;

/**
 * Interface SpecificationInterface
 * @package ALevel\DeepDi\Specification
 */
interface SpecificationInterface
{
    public function isSatisfiedBy(ProductInterface $product) : bool;
}