<?php

namespace App\DataFixtures;

use App\Entity\Sylabus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SylabusFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $sylabus1 = new Sylabus();
        $sylabus1->setNumerKatalogowy('ZIM-IN-2S-04L-31');

        $sylabus2 = new Sylabus();
        $sylabus2->setNumerKatalogowy('ZIM-IN-2S-04L-32');

        $manager->persist($sylabus1);
        $manager->persist($sylabus2);

        $this->addReference('sylabus1', $sylabus1);
        $this->addReference('sylabus2', $sylabus2);
        $manager->flush();
    }
}
