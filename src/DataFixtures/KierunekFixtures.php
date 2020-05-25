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
        $kierunek->setNazwa("Informatyka");
        $kierunek->setWydzial("Wydział Zastosowań Informatyki i Matematyki");

        $manager->persist($kierunek);

        $this->addReference('kierunek1', $kierunek);

        $manager->flush();
    }
}
