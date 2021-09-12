<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use App\Model\Entity\ShopInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\Shop\Service\ShopServiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class ShopResolver implements ResolverInterface
{
    private ShopServiceInterface $shopService;

    public function __construct(ShopServiceInterface $shopService)
    {
        $this->shopService = $shopService;
    }

    /**
     * @param int $id
     * @return ShopInterface
     * @throws SearchException
     */
    public function resolve(int $id): ShopInterface
    {
        return $this->shopService->find($id);
    }

    /**
     * @param int|null $limit
     * @return ArrayCollection
     */
    public function resolveCollection(?int $limit): ArrayCollection
    {
        return $this->shopService->getCollectionWithLimit($limit ?? 100);
    }

    public function __invoke(ResolveInfo $info, $value, Argument $args)
    {
        $method = $info->fieldName;
        return $this->$method($value, $args);
    }

    public function id(ShopInterface $shop): int
    {
        return $shop->getId();
    }

    public function name(ShopInterface $shop): string
    {
        return $shop->getName();
    }

    public function address(ShopInterface $shop): string
    {
        return $shop->getAddress();
    }

    public function flowers(ShopInterface $shop, Argument $args): Collection
    {
        var_dump($args);
        return $shop->getFlowers();
    }

    public function purchases(ShopInterface $shop): Collection
    {
        return $shop->getPurchases();
    }
}