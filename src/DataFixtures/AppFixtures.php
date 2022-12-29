<?php

namespace App\DataFixtures;

use App\Entity\Citation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        //Citation
        for ($i = 0; $i < 25; $i++)
        {
            $citation = new Citation();
            $citation->setFrench($this->faker->text(69))
                    ->setEnglish($this->faker->text(69))
                    ->setAuthor($this->faker->name());

            $manager->persist($citation);
        }

        $manager->flush();
    }
}
