<?php

declare(strict_types=1);

namespace App\Model\Entity;

interface AttributeInterface
{
    public function getId(): ?int;

    public function getAttribute(): ?string;

    public function setAttribute(string $attribute): AttributeInterface;
}