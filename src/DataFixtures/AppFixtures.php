<?php

namespace App\DataFixtures;

use App\Entity\Hat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = \Faker\Factory::create('en_US');

        for ($i = 0; $i < 127; $i++) {

            $hat = new Hat();
            $hat->setName($faker->name());
            $hat->setPrice($faker->randomFloat($nbMaxDecimals = 2, $min = 20, $max = 122));
            $manager->persist($hat);



        }

        $manager->flush();

    }
}
