<?php

declare(strict_types=1);

namespace App\Model\Module\FlowerAttribute\Service;

use App\Model\Entity\FlowerAttributeInterface;
use App\Model\Exception\SearchException;

interface FlowerAttributeServiceInterface
{
    /**
     * @param int $flowerId
     * @return FlowerAttributeInterface[]
     * @throws SearchException
     */
    public function getByFlowerId(int $flowerId): array;
}