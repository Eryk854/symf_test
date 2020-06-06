<?php

namespace App\Tests\Service;

use App\Entity\Program;
use App\Entity\ProgramPodsumowanie;
use App\Service\ProgramService;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class ProgramServiceTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testStworzPodsumowanie()
    {
        $repository = $this->entityManager
            ->getRepository(Program::class);
        $programService = new ProgramService($repository);

        $program = $repository->findOneBy(['opis' => 'Informatyka 1 stopień stacjonarne 2019/2020']);

        $podsumowanie = $programService->stworzPodsumowanie($program->getId());

        $this->assertNotNull($podsumowanie);
        for ($i = 0; $i < $podsumowanie->getLiczbaSemestrow(); $i++) {
            $sumy_ects_dla_semestru_status_1 = $this->getSumyEctsDlaStatus1($podsumowanie, $i);

            $sumy_ects_dla_semestru_status_2 = $this->getSumyEctsDlaStatus2($podsumowanie, $i);

            $sumy_ects_dla_semestru_status_3 = $this->getSumyEctsDlaStatus3($podsumowanie, $i);

            $sumy_godzin_dla_semestru = $this->getSumyGodzin($podsumowanie, $i);

            $this->assertEquals($podsumowanie->getSumyEctsDlaSemestru()[$i], $sumy_ects_dla_semestru_status_1);
            $this->assertEquals($podsumowanie->getSumyEctsDlaSemestru()[$i], $sumy_ects_dla_semestru_status_2);
            $this->assertEquals($podsumowanie->getSumyGodzinDlaSemestru()[$i], $sumy_godzin_dla_semestru);
            $this->assertLessThanOrEqual($podsumowanie->getSumyEctsDlaSemestru()[$i], $sumy_ects_dla_semestru_status_3);
        }
    }

    private function getSumyEctsDlaStatus1(ProgramPodsumowanie $podsumowanie, int $semestr)
    {
        return $podsumowanie->getSumyEctsDlaStatusZajecKierunkowe()[$semestr]
            + $podsumowanie->getSumyEctsDlaStatusZajecHuman()[$semestr]
            + $podsumowanie->getSumyEctsDlaStatusZajecPodstawowe()[$semestr];
    }

    private function getSumyEctsDlaStatus2(ProgramPodsumowanie $podsumowanie, int $semestr)
    {
        return $podsumowanie->getSumyEctsDlaStatusZajecDoWyboru()[$semestr]
            + $podsumowanie->getSumyEctsDlaStatusZajecObligatoryjnych()[$semestr];
    }

    private function getSumyEctsDlaStatus3(ProgramPodsumowanie $podsumowanie, int $semestr)
    {
        return $podsumowanie->getSumyEctsDlaStatusZajecNaukowe()[$semestr]
            + $podsumowanie->getSumyEctsDlaStatusZajecPraktyczne()[$semestr];
    }

    private function getSumyGodzin(ProgramPodsumowanie $podsumowanie, int $semestr)
    {
        return $podsumowanie->getSumyGodzinCwiczeniaDlaSemestrow()[$semestr]
            + $podsumowanie->getSumyGodzinLabDlaSemestrow()[$semestr]
            + $podsumowanie->getSumyGodzinProjektDlaSemestrow()[$semestr]
            + $podsumowanie->getSumyGodzinPraktykiDlaSemestrow()[$semestr]
            + $podsumowanie->getSumyGodzinWykladDlaSemestrow()[$semestr]
            + $podsumowanie->getSumyGodzinTerenDlaSemestrow()[$semestr];
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
