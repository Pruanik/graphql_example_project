<?php

declare(strict_types=1);

namespace App\Model\Module\FlowerAttribute\Service;

use App\Model\Module\FlowerAttribute\Dto\FlowerAttributeCreationDto;
use Spatie\DataTransferObject\DataTransferObjectError;

class FlowerAttributeDtoFiller implements FlowerAttributeDtoFillerInterface
{
    /**
     * @param array $args
     * @return FlowerAttributeCreationDto
     * @throws DataTransferObjectError
     */
    public function filling(array $args): FlowerAttributeCreationDto
    {
        return FlowerAttributeCreationDto::buildFromArray([
            'attributeName' => $args['attributeName'],
            'value'         => $args['value'],
        ]);
    }
}
