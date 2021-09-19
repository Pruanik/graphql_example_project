<?php

declare(strict_types=1);

namespace App\Model\Module\Attribute\Service;

use App\Model\Entity\AttributeInterface;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;

interface AttributeServiceInterface
{
    /**
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     */
    public function create(string $attributeName): AttributeInterface;
}
