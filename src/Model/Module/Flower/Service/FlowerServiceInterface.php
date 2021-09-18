<?php

declare(strict_types=1);

namespace App\Model\Module\Flower\Service;

use App\Model\Entity\FlowerInterface;
use App\Model\Entity\ShopInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\Flower\Dto\FlowerCreationDto;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;

interface FlowerServiceInterface
{
    /**
     * @param int $id
     * @return FlowerInterface
     * @throws SearchException
     */
    public function find(int $id): FlowerInterface;

    public function getCollectionWithLimit(int $limit = 100): ArrayCollection;

    public function findElementsByShopAndAttributeValue(ShopInterface $shop, ?string $attributeValue): ArrayCollection;

    /**
     * @param FlowerCreationDto $flowerDto
     * @return FlowerInterface
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     * @throws OptimisticLockException
     */
    public function create(FlowerCreationDto $flowerDto): FlowerInterface;
}