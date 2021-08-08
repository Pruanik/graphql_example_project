<?php

declare(strict_types=1);

namespace App\Model\Module\Shop\Service;

use App\Model\Entity\ShopInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\Shop\Repository\ShopRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;

class ShopService implements ShopServiceInterface
{
    private ShopRepositoryInterface $shopRepository;

    public function __construct(ShopRepositoryInterface $shopRepository) {
        $this->shopRepository = $shopRepository;
    }

    /**
     * @param int $id
     * @return ShopInterface
     * @throws SearchException
     */
    public function find(int $id): ShopInterface
    {
        return $this->shopRepository->getById($id);
    }

    public function getCollectionWithLimit(int $limit = 100): ArrayCollection
    {
        $flowers = $this->shopRepository->getWithLimit($limit);
        return new ArrayCollection($flowers);
    }
}