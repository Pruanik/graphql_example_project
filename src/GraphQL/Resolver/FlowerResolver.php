<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use App\Model\Entity\FlowerInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\Flower\Service\FlowerServiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class FlowerResolver implements ResolverInterface
{
    private FlowerServiceInterface $flowerService;

    public function __construct(FlowerServiceInterface $flowerService)
    {
        $this->flowerService = $flowerService;
    }

    /**
     * @param int $id
     * @return FlowerInterface
     * @throws SearchException
     */
    public function resolve(int $id): FlowerInterface
    {
        return $this->flowerService->find($id);
    }

    /**
     * @param int|null $limit
     * @return ArrayCollection
     */
    public function resolveCollection(?int $limit): ArrayCollection
    {
        return $this->flowerService->getCollectionWithLimit($limit ?? 100);
    }
}