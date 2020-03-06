<?php


namespace ALevel\DeepDi\Specification;


use Magento\Catalog\Api\Data\ProductInterface;

class OrSpecification implements SpecificationInterface
{
    /**
     * @var SpecificationInterface[]
     */
    private $specifications;

    /**
     * OrSpecification constructor.
     * @param SpecificationInterface[] $specifications
     */
    public  function __construct(array $specifications = [])
    {
        $this->specifications = $specifications;
    }

    /**
     * @param ProductInterface $product
     * @return bool
     */
    public function isSatisfiedBy(ProductInterface $product): bool
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($product)) {
                return true;
            }
        }

        return false;
    }
}