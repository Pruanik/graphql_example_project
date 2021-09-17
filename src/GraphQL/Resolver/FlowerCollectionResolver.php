<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use App\Model\Module\Flower\Service\FlowerServiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class FlowerCollectionResolver implements ResolverInterface
{
    private FlowerServiceInterface $flowerService;

    public function __construct(FlowerServiceInterface $flowerService)
    {
        $this->flowerService = $flowerService;
    }

    /**
     * @param int|null $limit
     * @return ArrayCollection
     */
    public function resolve(?int $limit): ArrayCollection
    {
        return $this->flowerService->getCollectionWithLimit($limit ?? 100);
    }
}