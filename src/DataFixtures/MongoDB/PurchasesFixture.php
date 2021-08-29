<?php

declare(strict_types=1);

namespace App\DataFixtures\MongoDB;

use App\Document\Purchase;
use Doctrine\Bundle\MongoDBBundle\Fixture\Fixture;
use Doctrine\Persistence\ObjectManager;

class PurchasesFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $purchase = new Purchase();
        $purchase->setCustomerName('Paul');
        $purchase->setFlowers([2,3,4]);
        $purchase->setShopId(4);
        $manager->persist($purchase);
        $manager->flush();
    }
}
