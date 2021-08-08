<?php

declare(strict_types=1);

namespace App\Model\Module\Flower\Service;

use App\Model\Entity\FlowerInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\Flower\Repository\FlowerRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;

class FlowerService implements FlowerServiceInterface
{
    private FlowerRepositoryInterface $flowerRepository;

    public function __construct(FlowerRepositoryInterface $flowerRepository) {
        $this->flowerRepository = $flowerRepository;
    }

    /**
     * @param int $id
     * @return FlowerInterface
     * @throws SearchException
     */
    public function find(int $id): FlowerInterface
    {
        return $this->flowerRepository->getById($id);
    }

    public function getCollectionWithLimit(int $limit = 100): ArrayCollection
    {
        $flowers = $this->flowerRepository->getWithLimit($limit);
        return new ArrayCollection($flowers);
    }
}