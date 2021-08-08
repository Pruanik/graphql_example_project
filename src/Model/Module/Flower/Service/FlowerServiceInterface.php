<?php

declare(strict_types=1);

namespace App\Model\Module\Flower\Service;

use App\Model\Entity\FlowerInterface;
use App\Model\Exception\SearchException;
use Doctrine\Common\Collections\ArrayCollection;

interface FlowerServiceInterface
{
    /**
     * @param int $id
     * @return FlowerInterface
     * @throws SearchException
     */
    public function find(int $id): FlowerInterface;

    public function getCollectionWithLimit(int $limit = 100): ArrayCollection;
}