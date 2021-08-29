<?php

declare(strict_types=1);

namespace App\Model\Module\Shop\Service;

use App\Entity\Shop;
use App\Model\Entity\ShopInterface;
use App\Model\Exception\SearchException;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @return Shop
     * @throws SearchException
     */
    public function getRandomShop(): Shop;
}