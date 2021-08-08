<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Entity\Flower;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FlowersFixture extends Fixture
{
    public const FLOWERS = [
        'Роза',
        'Хризантема',
        'Гвоздика',
        'Восточные лилии',
        'Гербера',
        'Тюльпан',
        'Азиатские лилии',
        'Фрезия',
        'Альстромерия',
        'Зверобой',
        'Ирис',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::FLOWERS as $flowerName) {
            $flower = new Flower();
            $flower->setName($flowerName);
            $manager->persist($flower);
            $this->addReference(self::getReferenceId($flowerName), $flower);
        }

        $manager->flush();
    }

    public static function getReferenceId(string $name): string
    {
        return md5($name);
    }
}
