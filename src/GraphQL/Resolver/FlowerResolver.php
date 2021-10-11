<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use App\Model\Entity\FlowerInterface;
use App\Model\Entity\ShopInterface;
use App\Model\Module\Flower\Service\FlowerServiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Overblog\DataLoader\DataLoader;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Psr\Container\ContainerInterface as PsrContainerInterface;
use RuntimeException;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FlowerResolver implements ResolverInterface
{
    private FlowerServiceInterface $flowerService;
    private PsrContainerInterface $container;

    public function __construct(
        FlowerServiceInterface $flowerService,
        PsrContainerInterface $container
    ) {
        $this->flowerService = $flowerService;
        $this->container = $container;
    }

    /**
     * @param int $id
     * @return FlowerInterface
     * @throws RuntimeException
     */
    public function resolve(int $id): FlowerInterface
    {
        $containerBuilder = new ContainerBuilder();
        /** @var DataLoader $flowersLoader */
        $flowersLoader = $containerBuilder->get('flowers_dataloader');

        if ($flowersLoader === null) {
            throw new RuntimeException('Flowers Loader did not find.');
        }
        return $flowersLoader->load($id);
    }

    public function resolveByAttributeAndShop(ShopInterface $shop, Argument $args): ArrayCollection
    {
        return $this->flowerService->findElementsByShopAndAttributeValue($shop, $args['attributeValue']);
    }
}