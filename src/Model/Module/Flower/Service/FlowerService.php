<?php

declare(strict_types=1);

namespace App\Model\Module\Flower\Service;

use App\Model\Entity\FlowerInterface;
use App\Model\Entity\ShopInterface;
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

    public function findElementsByShopAndAttributeValue(ShopInterface $shop, ?string $attributeValue): ArrayCollection
    {
        if ($attributeValue !== null) {
            $flowers = $this->flowerRepository->getByShopIdAndAttributeValue($shop->getId(), $attributeValue);
        } else {
            $flowers = $this->flowerRepository->getByShopId($shop->getId());
        }

        return new ArrayCollection($flowers);
    }
}