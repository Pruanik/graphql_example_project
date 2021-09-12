<?php

declare(strict_types=1);

namespace App\DataFixtures\MongoDB;

use App\Document\Purchase;
use App\Model\Entity\ShopInterface;
use App\Model\Exception\SearchException;
use App\Model\Module\Shop\Service\ShopServiceInterface;
use Doctrine\Bundle\MongoDBBundle\Fixture\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

class PurchasesFixture extends Fixture
{
    public const CUSTOMERS = [
        'Вася',
        'Петя',
        'Маша',
        'Катя',
        'Саша',
        'Женя',
    ];

    private ShopServiceInterface $shopService;

    public function __construct(
        ShopServiceInterface $shopService
    ) {
        $this->shopService = $shopService;
    }

    /**
     * @param ObjectManager $manager
     * @throws SearchException
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::CUSTOMERS as $customer) {
            $purchase = $this->createPurchase($customer);
            $manager->persist($purchase);
            $manager->flush();
        }
    }

    /**
     * @param string $name
     * @return Purchase
     * @throws SearchException
     * @throws Exception
     */
    private function createPurchase(string $name): Purchase
    {
        $shop = $this->getShop();
        $purchase = new Purchase();
        $purchase->setCustomerName($name);
        $purchase->setShopId($shop->getId());
        return $purchase;
    }

    /**
     * @return ShopInterface
     * @throws SearchException
     */
    private function getShop(): ShopInterface
    {
        return $this->shopService->getRandomShop();
    }
}
