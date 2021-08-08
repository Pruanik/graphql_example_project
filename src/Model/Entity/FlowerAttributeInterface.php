<?php

declare(strict_types=1);

namespace App\Model\Entity;

interface FlowerAttributeInterface
{
    public function getId(): ?int;

    public function getFlower(): ?FlowerInterface;

    public function setFlower(FlowerInterface $flower): FlowerAttributeInterface;

    public function getAttribute(): ?AttributeInterface;

    public function setAttribute(AttributeInterface $attribute): FlowerAttributeInterface;

    public function getValue(): ?string;

    public function setValue(string $value): self;
}