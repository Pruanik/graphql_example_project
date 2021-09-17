<?php

declare(strict_types=1);

namespace App\Model\Module\Flower\Service;

use App\Model\Module\Flower\Dto\FlowerCreationDto;
use Overblog\GraphQLBundle\Definition\Argument;
use Spatie\DataTransferObject\DataTransferObjectError;

interface FlowerCreationDtoFillerInterface
{
    /**
     * @param Argument $args
     * @return FlowerCreationDto
     * @throws DataTransferObjectError
     */
    public function fillingFromGraphQLArgument(Argument $args): FlowerCreationDto;
}
