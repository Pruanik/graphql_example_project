<?php

declare(strict_types=1);

namespace App\Model\Dto;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\DataTransferObjectError;

class BaseDto extends DataTransferObject implements BaseDtoInterface
{
    /**
     * @param array $parameters
     * @throws DataTransferObjectError
     */
    protected function __construct(array $parameters = [])
    {
        parent::__construct($parameters);
    }

    /**
     * @param array $parameters
     * @return $this
     * @throws DataTransferObjectError
     */
    public static function buildFromArray(array $parameters): BaseDtoInterface
    {
        return new static($parameters);
    }
}
