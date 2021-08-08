<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Entity\Shop;
use App\Model\Entity\FlowerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class ShopsFixture extends Fixture implements DependentFixtureInterface
{
    public const SHOPS = [
        [
            'name'    => 'L’Flowers',
            'address' => 'ул. Зайцева, 3',
        ],
        [
            'name'    => 'Gentle Flowers',
            'address' => 'наб. реки Фонтанки, 124',
        ],
        [
            'name'    => 'Flowersboom',
            'address' => 'переулок Ульяны Громовой, 3',
        ],
        [
            'name'    => 'Amsterdam flowers',
            'address' => 'пр-т Бакунина, 4',
        ],
        [
            'name'    => '«Букет 112»',
            'address' => 'проспект Энгельса, 33, к1',
        ],
        [
            'name'    => 'SEVER',
            'address' => 'Кожевенная линия, 36',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SHOPS as $shopInfo) {
            $shop = new Shop();
            $shop->setName($shopInfo['name']);
            $shop->setAddress($shopInfo['address']);

            $flowers = $this->getRandomFlowers();
            if (!empty($flowers)) {
                foreach ($flowers as $flowerName) {
                    /** @var FlowerInterface $flower */
                    $flower = $this->getReference(FlowersFixture::getReferenceId($flowerName));
                    $shop->addFlower($flower);
                }
            }

            $manager->persist($shop);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            FlowersFixture::class,
        ];
    }

    /**
     * @return array
     * @throws Exception
     */
    private function getRandomFlowers(): array
    {
        $flowers = FlowersFixture::FLOWERS;
        $flowersCount = count($flowers);
        shuffle($flowers);
        $flowersCountExist = random_int(0, $flowersCount);
        return array_slice($flowers, 0, $flowersCountExist);
    }
}
