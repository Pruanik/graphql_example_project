<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use App\Model\Entity\ShopInterface;
use Overblog\DataLoader\DataLoader;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Psr\Container\ContainerInterface as PsrContainerInterface;
use RuntimeException;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ShopResolver implements ResolverInterface
{
    private PsrContainerInterface $container;

    public function __construct(PsrContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param int $id
     * @return ShopInterface
     * @throws RuntimeException
     */
    public function resolve(int $id, $context)
    {
        $containerBuilder = new ContainerBuilder();
        /** @var DataLoader $shopsLoader */
        $shopsLoader = $this->container->get('overblog_dataloader.shops_loader');

        if ($shopsLoader === null) {
            throw new RuntimeException('Shops Loader did not find.');
        }
        return $shopsLoader->load($id);
    }
}