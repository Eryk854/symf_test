<?php

namespace App\DataFixtures;

use App\Entity\Semestr;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SemestrFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $semestr = new Semestr();
        $semestr->setNumerSemestru(1);
        $semestr->setRodzajSemestru("Zimowy");

        $semestr2 = new Semestr();
        $semestr2->setNumerSemestru(2);
        $semestr2->setRodzajSemestru("Letni");

        $semestr3 = new Semestr();
        $semestr3->setNumerSemestru(3);
        $semestr3->setRodzajSemestru("Zimowy");

        $semestr4 = new Semestr();
        $semestr4->setNumerSemestru(4);
        $semestr4->setRodzajSemestru("Letni");

        $semestr5 = new Semestr();
        $semestr5->setNumerSemestru(5);
        $semestr5->setRodzajSemestru("Zimowy");

        $semestr6 = new Semestr();
        $semestr6->setNumerSemestru(6);
        $semestr6->setRodzajSemestru("Letni");

        $semestr7 = new Semestr();
        $semestr7->setNumerSemestru(7);
        $semestr7->setRodzajSemestru("Zimowy");

        $manager->persist($semestr);
        $manager->persist($semestr2);
        $manager->persist($semestr3);
        $manager->persist($semestr4);
        $manager->persist($semestr5);
        $manager->persist($semestr6);
        $manager->persist($semestr7);

        $this->addReference('semestr1', $semestr);
        $this->addReference('semestr2', $semestr2);
        $this->addReference('semestr3', $semestr3);
        $this->addReference('semestr4', $semestr4);
        $this->addReference('semestr5', $semestr5);
        $this->addReference('semestr6', $semestr6);
        $this->addReference('semestr7', $semestr7);

        $manager->flush();
    }
}
