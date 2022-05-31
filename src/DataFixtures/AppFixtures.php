<?php

namespace App\DataFixtures;

use App\Factory\EjercicioFactory;
use App\Factory\UsuarioFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        UsuarioFactory::new()->createMany(20);
        EjercicioFactory::new()->createMany(20);

        $manager->flush();
    }
}
