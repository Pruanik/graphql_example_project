<?php

declare(strict_types=1);

namespace App\Model\Module\Shop\Service;

use App\Entity\Shop;
use App\Model\Entity\ShopInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\Flower\Service\FlowerServiceInterface;
use App\Model\Module\Purchase\Service\PurchaseServiceInterface;
use App\Model\Module\Shop\Dto\ShopCreationDto;
use App\Model\Module\Shop\Repository\ShopRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\MongoDBException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use InvalidArgumentException;

class ShopService implements ShopServiceInterface
{
    private ShopRepositoryInterface $shopRepository;
    private FlowerServiceInterface $flowerService;
    private PurchaseServiceInterface $purchasesService;

    public function __construct(
        ShopRepositoryInterface $shopRepository,
        FlowerServiceInterface $flowerService,
        PurchaseServiceInterface $purchasesService
    ) {
        $this->shopRepository = $shopRepository;
        $this->flowerService = $flowerService;
        $this->purchasesService = $purchasesService;
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

    /**
     * @return int[]
     */
    public function getAllIds(): array
    {
        $shopIds = $this->shopRepository->getAllIds();
        return array_map(static function ($column) {
            return (int)$column['id'];
        }, $shopIds);
    }

    /**
     * @return ShopInterface
     * @throws SearchException
     */
    public function getRandomShop(): ShopInterface
    {
        $shopIds = $this->getAllIds();
        $randomId = $shopIds[array_rand($shopIds)];
        return $this->shopRepository->getById($randomId);
    }

    /**
     * @param ShopCreationDto $shopDto
     * @return ShopInterface
     * @throws InvalidArgumentException
     * @throws MongoDBException
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     * @throws OptimisticLockException
     */
    public function create(ShopCreationDto $shopDto): ShopInterface
    {
        $shop = $this->findExistOrCreateNewByName($shopDto->name);
        $this->shopRepository->add($shop);

        $shop = $this->fillingFlowersForShop($shop, $shopDto);
        $shop = $this->fillingPurchasesForShop($shop, $shopDto);

        $this->shopRepository->save();

        return $shop;
    }

    private function findExistOrCreateNewByName(string $name): ShopInterface
    {
        $shop = $this->shopRepository->findByName($name);
        if ($shop === null) {
            $shop = new Shop();
            $shop->setName($name);
        }

        return $shop;
    }

    /**
     * @param ShopInterface $shop
     * @param ShopCreationDto $shopDto
     * @return ShopInterface
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     * @throws OptimisticLockException
     */
    private function fillingFlowersForShop(ShopInterface $shop, ShopCreationDto $shopDto): ShopInterface
    {
        if ($shopDto->flowers !== null) {
            foreach ($shopDto->flowers as $flowerDto) {
                $flower = $this->flowerService->create($flowerDto);
                $shop->addFlower($flower);
            }
        }

        return $shop;
    }

    /**
     * @param ShopInterface $shop
     * @param ShopCreationDto $shopDto
     * @return ShopInterface
     * @throws MongoDBException
     * @throws InvalidArgumentException
     */
    private function fillingPurchasesForShop(ShopInterface $shop, ShopCreationDto $shopDto): ShopInterface
    {
        if ($shopDto->purchases !== null) {
            foreach ($shopDto->purchases as $purchasesDto) {
                $purchases = $this->purchasesService->create($purchasesDto, $shop);
                $shop->addPurchase($purchases);
            }
        }

        return $shop;
    }
}
