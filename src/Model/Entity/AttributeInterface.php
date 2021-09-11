<?php

declare(strict_types=1);

namespace App\Model\Entity;

interface AttributeInterface
{
    public function getId(): ?int;

    public function getName(): ?string;

    public function setName(string $attribute): AttributeInterface;
}