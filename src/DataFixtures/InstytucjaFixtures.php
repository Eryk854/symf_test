<?php

namespace App\DataFixtures;

use App\Entity\Instytucja;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InstytucjaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $instytucja1 = new Instytucja();
        $instytucja1->setOpis('Nam molestie lorem cursus nisl varius, viverra feugiat diam facilisis.');
        $instytucja1->setAdres('00-000 Warszawa ul. Ulica 00');
        $instytucja1->setNazwaSkrocona('WZiM');
        $instytucja1->setPelnaNazwa('WYDZIAŁ ZASTOSOWAŃ INFORMATYKI I MATEMATYKI');

        $manager->persist($instytucja1);

        $this->addReference('instytucja', $instytucja1);
        $manager->flush();
    }
}
