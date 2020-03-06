<?php


namespace ALevel\DeepDi\Specification;

use Magento\Catalog\Api\Data\ProductInterface;

class AndSpecification implements SpecificationInterface
{
    /**
     * @var SpecificationInterface[]
     */
    private $specifications;

    /**
     * AndSpecification constructor.
     * @param SpecificationInterface[] $specification
     */
    public function __construct(array $specification = [])
    {
        $this->specifications = $specification;
    }

    /**
     * @param ProductInterface $product
     * @return bool
     */
    public function isSatisfiedBy(ProductInterface $product): bool
    {
        foreach ($this->specifications as $specification) {
            if (!$specification->isSatisfiedBy($product)) {
                return false;
            }
        }

        return true;
    }
}
