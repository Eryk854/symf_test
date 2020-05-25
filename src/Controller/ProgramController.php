<?php

namespace App\Controller;

use App\Entity\Kierunek;
use App\Entity\Program;
use App\Entity\Godziny;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProgramController extends AbstractController
{
    /**
     * @Route("/program", name="program")
     */
    public function index(Request $request)
    {
        $program_repository = $this->getDoctrine()->getRepository(Program::class);

        $kierunek_repository = $this->getDoctrine()->getRepository(Kierunek::class);

        $programy = $program_repository->findAllOrderedByRokAkademicki();

        $formy_studiow = $program_repository->findAllGroupedByFormaStudiow();

        $kierunki_id = $program_repository->findAllGroupedByKierunekId();

        $kierunki = array();

        $temp = 0;

        foreach($kierunki_id as $kierunek_id) {
            $kierunki[$temp] = $kierunek_repository->findByKierunekId($kierunek_id["kierunek_id"]);
            $temp = $temp + 1;
        }

        if (($request->request->get('selected_wydzial') && $request->request->get('selected_kierunek')) &&
            $request->request->get('selected_forma'))
        {
            $request_selected_wydzial = substr($request->request->get('selected_wydzial'), 1);
            $request_selected_kierunek = substr($request->request->get('selected_kierunek'), 1);
            $request_selected_forma = substr($request->request->get('selected_forma'), 1);


            $kierunek_id = -1;

            foreach($kierunki as $kierunek) {
                if ($kierunek[0]["nazwa"] == $request_selected_kierunek && $kierunek[0]["wydzial"] == $request_selected_wydzial) {
                    $kierunek_id = $kierunek[0]["id"];
                    break;
                }
            }

            $output_programy = array();
            $temp = 0;

            foreach($programy as $program) {
                if ($program["kierunek_id"] == $kierunek_id && $program["forma_studiow"] == $request_selected_forma) {
                    $output_programy[$temp] = $program;
                    $temp = $temp + 1;
                }
            }

            $arrData = ['output' => $output_programy];

            return new JsonResponse($arrData);
        }

        return $this->render('program/index.html.twig', [
            'formy_studiow' => $formy_studiow,
            'kierunki' => $kierunki,
        ]);
    }

    /**
     * @Route("/program/{query}", name="programId", methods={"GET"})
     */
    public function programId($query, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->find($query);

        $kierunek =  $program->getKierunek();
        $forma = $program->getFormaStudiow();
        $rok = $program->getRokAkademicki();

        $sylabusy = $program->getSylabusy();

        $wszystkie_zajecia = array();

        $temp = 0;

        foreach($sylabusy as $sylabus) {
            $zajecia = $sylabus->getZajecia();
            $wszystkie_zajecia[$temp]["semestr"] = $sylabus->getSemestr()->getNumerSemestru();
            $wszystkie_zajecia[$temp]["nazwa"] = $zajecia->getNazwaPolska();
            $wszystkie_zajecia[$temp]["sylabus_id"] = $sylabus->getId();
            $wszystkie_zajecia[$temp]["godziny_wykladowe"] = $zajecia->getGodziny()->getGodzinyWykladowe();
            $wszystkie_zajecia[$temp]["godziny_cwiczeniowe"] = $zajecia->getGodziny()->getGodzinyCwiczeniowe();
            $wszystkie_zajecia[$temp]["czas_pracy_wlasnej"] = $zajecia->getGodziny()->getCzasPracyWlasnej();
            $wszystkie_zajecia[$temp]["kryteria_oceniania"] = $zajecia->getKryteriaOceniania();
            $wszystkie_zajecia[$temp]["ects"] = $zajecia->getGodziny()->getECTS();
            $temp = $temp + 1;
        }

        $columns_1 = array_column($wszystkie_zajecia, 'semestr');
        $columns_2 = array_column($wszystkie_zajecia, 'nazwa');
        array_multisort($columns_1, SORT_ASC, $columns_2, SORT_ASC, $wszystkie_zajecia);

        //dump($wszystkie_zajecia);

        $url = 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
        $nowy_url = substr($url, 0, strpos($url, 'program'));
        $nowy_url .= 'sylabus/';

        return $this->render('program/program.html.twig', [
            'kierunek' => $kierunek,
            'forma' => $forma,
            'rok' => $rok,
            'zajecia' => $wszystkie_zajecia,
            'url' => $nowy_url
        ]);
    }
}