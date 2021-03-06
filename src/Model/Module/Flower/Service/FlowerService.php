<?php

declare(strict_types=1);

namespace App\Model\Module\Flower\Service;

use App\Entity\Flower;
use App\Model\Entity\FlowerInterface;
use App\Model\Entity\ShopInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\Flower\Dto\FlowerCreationDto;
use App\Model\Module\Flower\Repository\FlowerRepositoryInterface;
use App\Model\Module\FlowerAttribute\Service\FlowerAttributeServiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;

class FlowerService implements FlowerServiceInterface
{
    private FlowerRepositoryInterface $flowerRepository;
    private FlowerAttributeServiceInterface $flowerAttributeService;

    public function __construct(
        FlowerRepositoryInterface $flowerRepository,
        FlowerAttributeServiceInterface $flowerAttributeService
    ) {
        $this->flowerRepository = $flowerRepository;
        $this->flowerAttributeService = $flowerAttributeService;
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

    /**
     * @param FlowerCreationDto $flowerDto
     * @return FlowerInterface
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     * @throws OptimisticLockException
     */
    public function create(FlowerCreationDto $flowerDto): FlowerInterface
    {
        $flower = $this->findExistOrCreateNewByName($flowerDto->name);
        $flower = $this->fillingAttributesForFlower($flower, $flowerDto);

        $this->flowerRepository->save();
        return $flower;
    }

    /**
     * @param string $name
     * @return FlowerInterface
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     */
    private function findExistOrCreateNewByName(string $name): FlowerInterface
    {
        $flower = $this->flowerRepository->findByName($name);
        if ($flower === null) {
            $flower = new Flower();
            $flower->setName($name);
        }

        $this->flowerRepository->add($flower);
        return $flower;
    }

    /**
     * @param FlowerInterface $flower
     * @param FlowerCreationDto $flowerDto
     * @return FlowerInterface
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     */
    private function fillingAttributesForFlower(FlowerInterface $flower, FlowerCreationDto $flowerDto): FlowerInterface
    {
        if ($flowerDto->flowerAttributes !== null) {
            foreach ($flowerDto->flowerAttributes as $flowerAttribute) {
                $attribute = $this->flowerAttributeService->create($flowerAttribute, $flower);
                $flower->addFlowerAttribute($attribute);
            }
        }

        return $flower;
    }
}
