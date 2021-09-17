<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

class UsersFixture extends Fixture
{
    public const USERS = [
        [
            'apiKey'    => '25d55ad283aa400af464c76d713c07ad',
        ]
    ];

    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::USERS as $userInfo) {
            $user = new User();
            $user->setApiToken($userInfo['apiKey']);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
