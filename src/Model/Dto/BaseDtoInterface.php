<?php

declare(strict_types=1);

namespace App\Model\Dto;

interface BaseDtoInterface
{
    /**
     * @param array $parameters
     * @return $this
     */
    public static function buildFromArray(array $parameters): self;

    public function toArray(): array;
}