<?php

namespace ALevel\DeepDi\Console\Command;

use ALevel\DeepDi\Specification\SpecificationInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \ALevel\DeepDi\Specification\AndSpecification;
use ALevel\DeepDi\Specification\OrSpecification;

class ProductSpecificationCommand extends Command
{
    const COMMAND_NAME = 'alevel:product:specification';

    /**
     * @var SpecificationInterface[]
     */
    private $specifications;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        OrSpecification $andSpecification,
        array $specifications = [],
        string $name = null
    ) {
        $this->productRepository = $productRepository;
        $this->specifications = $specifications;

        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName(self::COMMAND_NAME)
            ->setDescription('test command')
            ->addArgument(
                'sku',
                InputArgument::REQUIRED,
                'type of specification'
            )->addArgument(
                'type',
                InputArgument::REQUIRED,
                'type of specification'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sku = $input->getArgument('sku');
        $type = $input->getArgument('type');

        try {
            $product = $this->productRepository->get($sku);

            if (empty($this->specifications[$type])) {
                $output->writeln(sprintf("<error>Specification %s not found</error>", $type));
                return -1;
            }

            $specification = $this->specifications[$type];

            if ($specification->isSatisfiedBy($product)) {
                $output->writeln(
                    sprintf(
                        "<info>The product %s is satisfied by specification %s</info>",
                        $sku,
                        $type
                    )
                );
            } else {
                $output->writeln(
                    sprintf(
                        "<comment>The product %s is not satisfied by specification %s</comment>",
                        $sku,
                        $type
                    )
                );
            }

        } catch (NoSuchEntityException $e) {
            $output->writeln(sprintf("<error>Product with sku: %s not found</error>", $sku));
        }
    }
}
