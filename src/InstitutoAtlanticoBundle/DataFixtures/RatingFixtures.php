<?php

namespace InstitutoAtlanticoBundle\DataFixtures;

use InstitutoAtlanticoBundle\Entity\Rating;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RatingFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($u = 1; $u <= 20; $u++) {
            for($m = 0; $m < 20; $m++) {
                $rating = new Rating();
                $rating->setUser($u);
                $rating->setMovie(mt_rand(1, 100));
                $rating->setRating(mt_rand(1, 5));
                $manager->persist($rating);
            }
        }

        $manager->flush();
    }
}