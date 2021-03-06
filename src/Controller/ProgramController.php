<?php

namespace App\Controller;

use App\Entity\Kierunek;
use App\Entity\Program;
use App\Repository\ProgramRepository;
use App\Service\ProgramService;
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

        $wszystkie_programy = $program_repository->findAll();

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
            'programy' => $wszystkie_programy,
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

        $sylabusy = $program->getSylabusy();

        $wszystkie_zajecia = array();

        $temp = 0;

        foreach($sylabusy as $sylabus) {
            $zajecia = $sylabus->getZajecia();
            $godziny = $zajecia->getGodziny();
            $wszystkie_zajecia[$temp]["semestr"] = $sylabus->getSemestr()->getNumerSemestru();
            $wszystkie_zajecia[$temp]["nazwa"] = $zajecia->getNazwaPolska();
            $wszystkie_zajecia[$temp]["sylabus_id"] = $sylabus->getId();

            $wszystkie_zajecia[$temp]["status1"] = $zajecia->getStatus1();
            $wszystkie_zajecia[$temp]["status2"] = $zajecia->getStatus2();
            $wszystkie_zajecia[$temp]["status3"] = $zajecia->getStatus3();
            $wszystkie_zajecia[$temp]["status4"] = $zajecia->getStatusHumanistycznoSpoleczne();
            $wszystkie_zajecia[$temp]["status5"] = $zajecia->getStatusNaukowe();
            $wszystkie_zajecia[$temp]["status6"] = $zajecia->getStatusObowiazkowe();
            $wszystkie_zajecia[$temp]["status7"] = $zajecia->getStatusPodstawowe();
            $wszystkie_zajecia[$temp]["status8"] = $zajecia->getStatusPraktyczne();

            $wszystkie_zajecia[$temp]["gw"] = $godziny->getGodzinyWykladowe();
            $wszystkie_zajecia[$temp]["gc"] = $godziny->getGodzinyCwiczeniowe();
            $wszystkie_zajecia[$temp]["gl"] = $godziny->getGodzinyLaboratoryjne();
            $wszystkie_zajecia[$temp]["gp"] = $godziny->getGodzinyProjektowe();
            $wszystkie_zajecia[$temp]["gt"] = $godziny->getGodzinyTerenowe();
            $wszystkie_zajecia[$temp]["gpr"] = $godziny->getGodzinyPraktyki();
            $wszystkie_zajecia[$temp]["suma"] = $godziny->getSumaGodzin();

            $wszystkie_zajecia[$temp]["ects"] = $zajecia->getGodziny()->getECTS();

            $wszystkie_zajecia[$temp]["kryteria_oceniania"] = $zajecia->getKryteriaOceniania();

            $temp = $temp + 1;
        }

        $columns_1 = array_column($wszystkie_zajecia, 'semestr');
        $columns_2 = array_column($wszystkie_zajecia, 'nazwa');
        array_multisort($columns_1, SORT_ASC, $columns_2, SORT_ASC, $wszystkie_zajecia);

        return $this->render('program/program.html.twig', [
            'program' => $program,
            'zajecia' => $wszystkie_zajecia
        ]);
    }

    /**
     * @Route("/program/{query}/podsumowanie", name="programIdPodsumowanie", methods={"GET"})
     */
    public function programIdPodsumowanie($query, ProgramService $program_service): Response
    {
        $program_podsumowanie = $program_service->stworzPodsumowanie($query);

        return $this->render('program/program_podsumowanie.html.twig', [
            'program_podsumowanie' => $program_podsumowanie
        ]);
    }
}