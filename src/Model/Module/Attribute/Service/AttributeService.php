<?php

declare(strict_types=1);

namespace App\Model\Module\Attribute\Service;

use App\Entity\Attribute;
use App\Model\Entity\AttributeInterface;
use App\Model\Module\Attribute\Repository\AttributeRepositoryInterface;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;

class AttributeService implements AttributeServiceInterface
{
    private AttributeRepositoryInterface $attributeRepository;

    public function __construct(AttributeRepositoryInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     */
    public function create(string $attributeName): AttributeInterface
    {
        $attribute = $this->findExistOrCreateNewByName($attributeName);
        $this->attributeRepository->add($attribute);
        $this->attributeRepository->save();

        return $attribute;
    }

    private function findExistOrCreateNewByName(string $name): AttributeInterface
    {
        $attribute = $this->attributeRepository->findByName($name);
        if ($attribute === null) {
            $attribute = new Attribute();
            $attribute->setName($name);
        }

        return $attribute;
    }
}
