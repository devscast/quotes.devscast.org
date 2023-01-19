<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Citation;
use App\Entity\User;
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
        //User
        //$admins = [];
        $admin = new User();
        $admin->setFullName('Admin')
            ->setEmail('admin@devscast.tech')
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
            ->setPlainPassword('password');

        //$admins[] = $admin;
        $manager->persist($admin);

        //Citation
        for ($i = 0; $i < 15; $i++)
        {
            $citation = new Citation();
            $citation->setFrench($this->faker->text(69))
                    ->setEnglish($this->faker->text(69))
                    ->setAuthor($this->faker->name());

            $manager->persist($citation);
        }

        //Author
        for ($j = 0; $j < 15; $j++)
        {
            $author = new Author();
            $author->setName($this->faker->word())
                    ->setDescription($this->faker->text(69))
                    ->setRoles($this->faker->title());

            $manager->persist($author);
        }

        $manager->flush();
    }
}
