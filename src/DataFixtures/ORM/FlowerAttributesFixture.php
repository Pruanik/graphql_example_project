<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Entity\FlowerAttribute;
use App\Model\Entity\AttributeInterface;
use App\Model\Entity\FlowerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class FlowerAttributesFixture extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        foreach (FlowersFixture::FLOWERS as $flowerName) {
            $flowerAttribute = new FlowerAttribute();
            /** @var FlowerInterface $flower */
            $flower = $this->getReference(FlowersFixture::getReferenceId($flowerName));

            foreach (AttributesFixture::ATTRIBUTES as $attributeInfo) {
                if (random_int(1, 3) === 3) {
                    continue;
                }

                /** @var AttributeInterface $attribute */
                $attribute = $this->getReference(AttributesFixture::getReferenceId($attributeInfo['name']));
                $value = $this->getRandomValue($attributeInfo['variants']);

                $flowerAttribute->setFlower($flower);
                $flowerAttribute->setAttribute($attribute);
                $flowerAttribute->setValue($value);

                $manager->persist($flowerAttribute);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            FlowersFixture::class,
            AttributesFixture::class,
        ];
    }

    private function getRandomValue(array $values): string
    {
        $rand_keys = array_rand($values);
        return $values[$rand_keys];
    }
}
