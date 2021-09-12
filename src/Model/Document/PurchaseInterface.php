<?php

declare(strict_types=1);

namespace App\Model\Document;

interface PurchaseInterface
{
    public function getId();

    public function getCustomerName(): string;

    public function setCustomerName(string $customerName): void;

    public function getShopId(): int;

    public function setShopId(int $shopId): void;
}