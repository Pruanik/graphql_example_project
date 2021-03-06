<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Doctrine\Common\Collections\Collection;

interface FlowerInterface
{
    public function getId(): ?int;

    public function getName(): ?string;

    public function setName(string $name): self;

    /**
     * @return Collection|ShopInterface[]
     */
    public function getShops(): Collection;

    public function addShop(ShopInterface $shop): FlowerInterface;

    /**
     * @return Collection|FlowerAttributeInterface[]
     */
    public function getFlowerAttributes(): Collection;

    public function addFlowerAttribute(FlowerAttributeInterface $flowerAttribute): FlowerInterface;
}