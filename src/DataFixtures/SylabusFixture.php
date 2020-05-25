<?php

namespace App\DataFixtures;

use App\Entity\Sylabus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SylabusFixture extends Fixture implements DependentFixtureInterface
{
    const liczbaSylabusowNaSemestr = 6;
    const liczbaSemestrowNaProgram = 5;
    const liczbaProgramow = 4;

    public function load(ObjectManager $manager)
    {
        for ($program = 1; $program <= SylabusFixture::liczbaProgramow; $program++) {
            for ($sem = 1; $sem <= SylabusFixture::liczbaSemestrowNaProgram; $sem++) {
                for ($i = 1; $i <= SylabusFixture::liczbaSylabusowNaSemestr; $i++) {
                    $sylabus = new Sylabus();
                    $rodzajSemestru = ($sem % 2) == 1 ? 'Z' : 'L';
                    $sylabus->setNumerKatalogowy('ZIM-IN-1S-0' . $sem . $rodzajSemestru . '-' . str_pad($i, 2, "0", STR_PAD_LEFT));
                    $sylabus->setZajecia($this->getReference('zajecia' . $sem . $i . $program));
                    $sylabus->setProgram($this->getReference('program' . $program));
                    $sylabus->setJednostkaRealizujaca($this->getReference('instytucja'));
                    $sylabus->setJednostkaZlecajaca($this->getReference('instytucja'));
                    $sylabus->setSemestr($this->getReference('semestr' . $sem));

                    $manager->persist($sylabus);
                    $this->addReference('sylabus' . $program . $sem . $i, $sylabus);
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ZajeciaFixtures::class,
            ProgramFixtures::class,
            InstytucjaFixtures::class,
            SemestrFixtures::class
        );
    }
}
