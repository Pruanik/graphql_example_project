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
            'address' => 'Avinguda del Mar, 2',
        ],
        [
            'name'    => 'Gentle Flowers',
            'address' => 'Carrer d\'Albert Ferrer i Soler',
        ],
        [
            'name'    => 'Flowersboom',
            'address' => 'Carrer de la Creu, 16',
        ],
        [
            'name'    => 'Amsterdam flowers',
            'address' => 'Carrer de Francesc Bellapart, 1',
        ],
        [
            'name'    => '«Bouquet 112»',
            'address' => 'Carrer de l\'Esglesia, 9',
        ],
        [
            'name'    => 'SEVER',
            'address' => 'Avinguda del Mar, 28',
        ],
    ];

    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
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
        $flowersCountExist = random_int(1, $flowersCount);
        return array_slice($flowers, 0, $flowersCountExist);
    }
}
