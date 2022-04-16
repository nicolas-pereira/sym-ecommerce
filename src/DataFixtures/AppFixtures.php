<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('en_US');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 50; $i += 1) {
            $product = new Product();
            $product->setName($this->faker->words($this->faker->numberBetween(1, 3), true));
            $product->setDescription($this->faker->paragraph($this->faker->numberBetween(1, 4)));
            $product->setPrice($this->faker->numberBetween(1, 10000));
            $manager->persist($product);
        }
        $manager->flush();
    }
}
