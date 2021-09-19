<?php

declare(strict_types=1);

namespace App\Model\Entity;

use App\Model\Document\PurchaseInterface;
use Doctrine\Common\Collections\Collection;

interface ShopInterface
{
    public function getId(): ?int;

    public function getName(): ?string;

    public function setName(string $name): self;

    public function getAddress(): ?string;

    public function setAddress(?string $address): self;

    /**
     * @return Collection|FlowerInterface[]
     */
    public function getFlowers(): Collection;

    public function addFlower(FlowerInterface $flower): ShopInterface;

    /**
     * @return Collection|PurchaseInterface[]
     */
    public function getPurchases(): Collection;

    public function addPurchase(PurchaseInterface $purchase): ShopInterface;
}