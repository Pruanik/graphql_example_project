<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use App\Model\Entity\ShopInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\Shop\Service\ShopServiceInterface;
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
}