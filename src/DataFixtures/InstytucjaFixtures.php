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
        $instytucja1->setOpis('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');
        $instytucja1->setAdres('00-000 Warszawa ul. Ulica 00');
        $instytucja1->setNazwaSkrocona('WNE');
        $instytucja1->setPelnaNazwa('Wydział Nauk Ekonomicznych');


        $instytucja2 = new Instytucja();
        $instytucja2->setOpis('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum accumsan arcu at est elementum, scelerisque commodo lectus varius.');
        $instytucja2->setAdres('00-000 Warszawa ul. Ulica 00');
        $instytucja2->setNazwaSkrocona('WL');
        $instytucja2->setPelnaNazwa('WYDZIAŁ LEŚNY');

        $instytucja3 = new Instytucja();
        $instytucja3->setOpis('Nam molestie lorem cursus nisl varius, viverra feugiat diam facilisis.');
        $instytucja3->setAdres('00-000 Warszawa ul. Ulica 00');
        $instytucja3->setNazwaSkrocona('WBiIŚ');
        $instytucja3->setPelnaNazwa('WYDZIAŁ BUDOWNICTWA I INŻYNIERII ŚRODOWISKA');

        $instytucja4 = new Instytucja();
        $instytucja4->setOpis('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum accumsan arcu at est elementum, scelerisque commodo lectus varius.');
        $instytucja4->setAdres('00-000 Warszawa ul. Ulica 00');
        $instytucja4->setNazwaSkrocona('');
        $instytucja4->setPelnaNazwa('');

        $instytucja5 = new Instytucja();
        $instytucja5->setOpis('Nam molestie lorem cursus nisl varius, viverra feugiat diam facilisis.');
        $instytucja5->setAdres('00-000 Warszawa ul. Ulica 00');
        $instytucja5->setNazwaSkrocona('WZiM');
        $instytucja5->setPelnaNazwa('WYDZIAŁ ZASTOSOWAŃ INFORMATYKI I MATEMATYKI');

        $manager->persist($instytucja1);
        $manager->persist($instytucja2);
        $manager->persist($instytucja3);
        $manager->persist($instytucja4);
        $manager->persist($instytucja5);

        $this->addReference('instytucja1', $instytucja1);
        $this->addReference('instytucja2', $instytucja2);
        $this->addReference('instytucja3', $instytucja3);
        $this->addReference('instytucja4', $instytucja4);
        $this->addReference('instytucja5', $instytucja5);
        $manager->flush();
    }
}
