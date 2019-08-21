<?php

namespace InstitutoAtlanticoBundle\DataFixtures;

use InstitutoAtlanticoBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $names = ['Alice', 'Miguel', 'Sophia', 'Arthur', 'Helena', 'Bernardo', 'Valentina',	'Heitor',
            'Laura', 'Davi', 'Isabella', 'Lorenzo', 'Manuela', 'Theo', 'Julia', 'Pedro', 'Heloisa', 'Gabriel', 'Luiza', 'Enzo'];

        foreach ($names as $name) {
            $user = new User();
            $user->setName($name);
            $user->setEmail(strtolower($name).mt_rand(1,20).'@mailinator.com');
            $manager->persist($user);
        }

        $manager->flush();
    }
}