<?php

declare(strict_types=1);

namespace App\GraphQL\Resolver;

use App\Model\Entity\FlowerAttributeInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\FlowerAttribute\Service\FlowerAttributeServiceInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class FlowerAttributeResolver implements ResolverInterface
{
    private FlowerAttributeServiceInterface $flowerAttributeService;

    public function __construct(FlowerAttributeServiceInterface $flowerAttributeService)
    {
        $this->flowerAttributeService = $flowerAttributeService;
    }

    /**
     * @param int $id
     * @return FlowerAttributeInterface[]
     * @throws SearchException
     */
    public function resolve(int $id): array
    {
        return $this->flowerAttributeService->getByFlowerId($id);
    }
}