<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Sylabus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProgramController extends AbstractController
{
    /**
     * @Route("/program", name="program")
     */
    public function index(Request $request)
    {
        $program_repository = $this->getDoctrine()->getRepository(Program::class);

        $rok_akademicki = $program_repository->findAllGroupedByRokAkademicki();

        $forma_studiow = $program_repository->findAllGroupedByFormaStudiow();

        $poziom_studiow = $program_repository->findAllGroupedByPoziomStudiow();

        $programy = $program_repository->findAll();

        $sylabusy = $this->getDoctrine()->getRepository(Sylabus::class)->findAll();

        if ($request->request->get('selected_poziom'))
        {
            $request_selected_rok = substr($request->request->get('selected_rok'), 1);
            $request_selected_forma = substr($request->request->get('selected_forma'), 1);
            $request_selected_poziom = substr($request->request->get('selected_poziom'), 1);

            $output_programyId = array();
            $temp = 0;

            foreach($programy as $program)
            {
                if (($program->getRokAkademicki() == $request_selected_rok && $program->getFormaStudiow() == $request_selected_forma) &&
                    ($program->getPoziomStudiow()) == $request_selected_poziom)
                {
                    $output_programyId[$temp] = $program->getId();
                    $temp = $temp + 1;
                }
            }

            $output_sylabusyId = array();
            $output_sylabusyNumKat = array();
            $temp = 0;

            foreach($sylabusy as $sylabus)
            {
                foreach ($output_programyId as $id)
                {
                    if ($id == $sylabus->getProgram()->getId())
                    {
                        $output_sylabusyId[$temp] = $sylabus->getId();
                        $output_sylabusyNumKat[$temp] = $sylabus->getNumerKatalogowy();

                        $temp = $temp + 1;
                    }
                }
            }

            $arrData = ['output' => $output_sylabusyId, 'output2' => $output_sylabusyNumKat];

            return new JsonResponse($arrData);
        }

        return $this->render('program/index.html.twig', [
            'rok_akademicki' => $rok_akademicki,
            'forma_studiow' => $forma_studiow,
            'poziom_studiow' => $poziom_studiow,
        ]);
    }
}