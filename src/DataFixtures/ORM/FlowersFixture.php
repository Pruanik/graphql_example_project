<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Entity\Flower;
use App\Entity\FlowerAttribute;
use App\Model\Entity\AttributeInterface;
use App\Model\Entity\FlowerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

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

    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::FLOWERS as $flowerName) {
            $flower = new Flower();
            $flower->setName($flowerName);
            $flower = $this->addFlowerAttributes($flower);
            $manager->persist($flower);
            $this->addReference(self::getReferenceId($flowerName), $flower);
        }

        $manager->flush();
    }

    /**
     * @param FlowerInterface $flower
     * @return FlowerInterface
     * @throws Exception
     */
    private function addFlowerAttributes(FlowerInterface $flower): FlowerInterface
    {
        foreach (AttributesFixture::ATTRIBUTES as $attributeInfo) {
            if (random_int(1, 3) === 3) {
                continue;
            }

            $flowerAttribute = new FlowerAttribute();
            /** @var AttributeInterface $attribute */
            $attribute = $this->getReference(AttributesFixture::getReferenceId($attributeInfo['name']));
            $value = $this->getRandomValue($attributeInfo['variants']);

            $flowerAttribute->setFlower($flower);
            $flowerAttribute->setAttribute($attribute);
            $flowerAttribute->setValue($value);
            $flower->addFlowerAttribute($flowerAttribute);
        }

        return $flower;
    }

    private function getRandomValue(array $values): string
    {
        $rand_keys = array_rand($values);
        return $values[$rand_keys];
    }

    public static function getReferenceId(string $name): string
    {
        return md5($name);
    }
}
