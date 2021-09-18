<?php

declare(strict_types=1);

namespace App\Model\Module\Flower\Service;

use App\Model\Module\Flower\Dto\FlowerCreationDto;
use App\Model\Module\FlowerAttribute\Service\FlowerAttributeDtoFillerInterface;
use Spatie\DataTransferObject\DataTransferObjectError;

class FlowerCreationDtoFiller implements FlowerCreationDtoFillerInterface
{
    private FlowerAttributeDtoFillerInterface $flowerAttributeDtoFiller;

    public function __construct(FlowerAttributeDtoFillerInterface $flowerAttributeDtoFiller)
    {
        $this->flowerAttributeDtoFiller = $flowerAttributeDtoFiller;
    }

    /**
     * @param array $args
     * @return FlowerCreationDto
     * @throws DataTransferObjectError
     */
    public function filling(array $args): FlowerCreationDto
    {
        $buildArray = [
            'name' => $args['name'],
        ];

        if (isset($args['flowerAttributes'])) {
            foreach ($args['flowerAttributes'] as $attribute) {
                $buildArray['flowerAttributes'][] = $this->flowerAttributeDtoFiller->filling($attribute);
            }
        }

        return FlowerCreationDto::buildFromArray($buildArray);
    }
}
