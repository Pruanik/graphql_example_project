<?php

declare(strict_types=1);

namespace App\Document;

use App\Model\Document\PurchaseInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(db="purchases", collection="graphql_example")
 */
class Purchase implements PurchaseInterface
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $customerName;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $shopId;

    /**
     * @MongoDB\Field(type="collection")
     */
    protected $flowers;

    public function getId()
    {
        return $this->id;
    }

    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    public function setCustomerName(string $customerName): void
    {
        $this->customerName = $customerName;
    }

    public function getShopId(): int
    {
        return $this->shopId;
    }

    public function setShopId(int $shopId): void
    {
        $this->shopId = $shopId;
    }

    public function getFlowers(): array
    {
        return $this->flowers;
    }

    public function setFlowers(array $flowers): void
    {
        $this->flowers = $flowers;
    }
}