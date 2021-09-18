<?php

declare(strict_types=1);

namespace App\Model\Module\Attribute\Repository;

use App\Model\Entity\AttributeInterface;

interface AttributeRepositoryInterface
{
    public function findByName(string $name): ?AttributeInterface;
}
