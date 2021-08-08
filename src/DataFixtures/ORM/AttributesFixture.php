<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Entity\Attribute;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AttributesFixture extends Fixture
{
    public const ATTRIBUTES = [
        [
            'name'     => 'Цвет',
            'variants' => ['Красный', 'Зеленый', 'Желтый', 'Малиновый'],
        ],
        [
            'name'     => 'Срок хранения',
            'variants' => ['1 день', '2 дня', '3 дня', '4 дня', '5 дней'],
        ],
        [
            'name'     => 'Длина стебля',
            'variants' => ['50 см', '60 см', '70-90 см', '100 см'],
        ],
        [
            'name'     => 'Съедобна ли?',
            'variants' => ['Да', 'Нет'],
        ],
        [
            'name'     => 'Толщина бутона',
            'variants' => ['4,3 см', '4,5 см', '5 см', '5,5 см'],
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::ATTRIBUTES as $attributeInfo) {
            $attribute = new Attribute();
            $attribute->setAttribute($attributeInfo['name']);
            $manager->persist($attribute);
            $this->addReference(self::getReferenceId($attributeInfo['name']), $attribute);
        }

        $manager->flush();
    }

    public static function getReferenceId(string $name): string
    {
        return md5($name);
    }
}
