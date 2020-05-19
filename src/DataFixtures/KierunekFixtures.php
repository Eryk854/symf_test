<?php

namespace App\DataFixtures;

use App\Entity\Kierunek;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class KierunekFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $kierunek = new Kierunek();
        $kierunek->setInformacje("Informacje o kierunku");

        $kierunek2 = new Kierunek();
        $kierunek2->setInformacje("Informacje o kierunku2");

        $manager->persist($kierunek);
        $manager->persist($kierunek2);

        $this->addReference('kierunek1', $kierunek);
        $this->addReference('kierunek2', $kierunek2);

        $manager->flush();
    }
}
