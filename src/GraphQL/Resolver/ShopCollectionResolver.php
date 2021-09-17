<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use App\Model\Module\Shop\Service\ShopServiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class ShopCollectionResolver implements ResolverInterface
{
    private ShopServiceInterface $shopService;

    public function __construct(ShopServiceInterface $shopService)
    {
        $this->shopService = $shopService;
    }

    /**
     * @param int|null $limit
     * @return ArrayCollection
     */
    public function resolve(?int $limit): ArrayCollection
    {
        return $this->shopService->getCollectionWithLimit($limit ?? 100);
    }
}