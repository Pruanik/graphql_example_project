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
            'name'     => 'Color',
            'variants' => ['Red', 'Green', 'Yellow', 'Purple'],
        ],
        [
            'name'     => 'Shelf life',
            'variants' => ['1 day', '2 days', '3 days', '4 days', '5 days'],
        ],
        [
            'name'     => 'Flower stem length',
            'variants' => ['50 sm', '60 sm', '70-90 sm', '100 sm'],
        ],
        [
            'name'     => 'Bud thickness',
            'variants' => ['4,3 sm', '4,5 sm', '5 sm', '5,5 sm'],
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::ATTRIBUTES as $attributeInfo) {
            $attribute = new Attribute();
            $attribute->setName($attributeInfo['name']);
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
