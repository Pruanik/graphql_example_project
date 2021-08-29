<?php

declare(strict_types=1);

namespace App\Model\Module\FlowerAttribute\Service;

use App\Model\Entity\FlowerAttributeInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\FlowerAttribute\Repository\FlowerAttributeRepositoryInterface;
use App\Repository\FlowerRepository;

class FlowerAttributeService implements FlowerAttributeServiceInterface
{
    private FlowerAttributeRepositoryInterface $flowerAttributeRepository;
    private FlowerRepository $flowerRepository;

    public function __construct(
        FlowerAttributeRepositoryInterface $flowerAttributeRepository,
        FlowerRepository $flowerRepository
    ) {
        $this->flowerAttributeRepository = $flowerAttributeRepository;
        $this->flowerRepository = $flowerRepository;
    }

    /**
     * @param int $flowerId
     * @return FlowerAttributeInterface[]
     * @throws SearchException
     */
    public function getByFlowerId(int $flowerId): array
    {
        $flower = $this->flowerRepository->getById($flowerId);
        return $this->flowerAttributeRepository->getByFlower($flower);
    }
}
