<?php

declare(strict_types=1);

namespace App\Model\Module\Shop\Service;

use App\Entity\Shop;
use App\Model\Entity\ShopInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\Shop\Dto\ShopCreationDto;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;

interface ShopServiceInterface
{
    /**
     * @param int $id
     * @return ShopInterface
     * @throws SearchException
     */
    public function find(int $id): ShopInterface;

    public function getCollectionWithLimit(int $limit = 100): ArrayCollection;

    /**
     * @return ShopInterface
     * @throws SearchException
     */
    public function getRandomShop(): ShopInterface;

    /**
     * @param ShopCreationDto $shopDto
     * @return ShopInterface
     * @throws ORMException
     * @throws ORMInvalidArgumentException
     * @throws OptimisticLockException
     */
    public function create(ShopCreationDto $shopDto): ShopInterface;
}
