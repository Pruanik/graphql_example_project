<?php

declare(strict_types=1);

namespace App\Document;

use App\Model\Document\PurchaseInterface;
use App\Repository\PurchaseRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\Document(repositoryClass=PurchaseRepository::class)
 */
class Purchase implements PurchaseInterface
{
    /**
     * @var int
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @var string
     * @MongoDB\Field(type="string")
     */
    protected $customerName;

    /**
     * @Gedmo\ReferenceOne(type="entity", class="App\Entity\Shop", inversedBy="purchases", identifier="shopId", mappedBy="shopId")
     */
    protected $shop;

    /**
     * @var int
     * @MongoDB\Field(type="int")
     */
    protected $shopId;

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
}