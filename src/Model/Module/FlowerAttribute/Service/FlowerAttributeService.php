<?php

declare(strict_types=1);

namespace App\Model\Module\FlowerAttribute\Service;

use App\Entity\FlowerAttribute;
use App\Model\Entity\AttributeInterface;
use App\Model\Entity\FlowerAttributeInterface;
use App\Model\Entity\FlowerInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\Attribute\Service\AttributeServiceInterface;
use App\Model\Module\Flower\Repository\FlowerRepositoryInterface;
use App\Model\Module\FlowerAttribute\Dto\FlowerAttributeCreationDto;
use App\Model\Module\FlowerAttribute\Repository\FlowerAttributeRepositoryInterface;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;

class FlowerAttributeService implements FlowerAttributeServiceInterface
{
    private FlowerAttributeRepositoryInterface $flowerAttributeRepository;
    private AttributeServiceInterface $attributeService;
    private FlowerRepositoryInterface $flowerRepository;

    public function __construct(
        FlowerAttributeRepositoryInterface $flowerAttributeRepository,
        AttributeServiceInterface $attributeService,
        FlowerRepositoryInterface $flowerRepository
    ) {
        $this->flowerAttributeRepository = $flowerAttributeRepository;
        $this->attributeService = $attributeService;
        $this->flowerRepository = $flowerRepository;
    }

    /**
     * @param int $flowerId
     * @return FlowerAttributeInterface[]
     * @throws SearchException
     */
    public function getByFlowerId(int $flowerId): array
    {
        $flower = $this->flowerRepository->getById($flowerId);
        return $this->flowerAttributeRepository->getByFlower($flower);
    }

    /**
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     */
    public function create(
        FlowerAttributeCreationDto $flowerAttributeDto,
        FlowerInterface $flower
    ): FlowerAttributeInterface {
        $attribute = $this->attributeService->create($flowerAttributeDto->attributeName);
        $flowerAttribute = $this->findExistOrCreateNewByAttributeAndFlower($attribute, $flower);
        $flowerAttribute->setValue($flowerAttributeDto->value);

        $this->flowerAttributeRepository->add($flowerAttribute);
        $this->flowerAttributeRepository->save();

        return $flowerAttribute;
    }

    private function findExistOrCreateNewByAttributeAndFlower(
        AttributeInterface $attribute,
        FlowerInterface $flower
    ): FlowerAttributeInterface {
        $flowerAttribute = $this->flowerAttributeRepository->findByAttributeAndFlower($attribute, $flower);

        if ($flowerAttribute === null) {
            $flowerAttribute = new FlowerAttribute();

            $flowerAttribute->setAttribute($attribute);
            $flowerAttribute->setFlower($flower);
        }

        return $flowerAttribute;
    }
}
