<?php

namespace App\Controller;

#use http\Env\Request;
use App\Entity\Godziny;
use App\Entity\Program;
use App\Entity\Sylabus;
use App\Entity\Zajecia;
use App\Forms\Type\HourType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Forms\Type\SylabusType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * @Route("/sylabus")
 */
class SylabusController extends AbstractController
{
    /**
     * @Route("/form/{id}", name="app_lucky_number")
     */
    public function number(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager(); # polaczenie do bazy

        $sylabus = $this->getDoctrine()->getRepository(Sylabus::class)->find($id); #bierzemy z bazy sylabus po id względem url
        $nazwa_zajec_polska = $this->getDoctrine()->getRepository(Zajecia::class)->find($sylabus->getZajecia()->getId())->getNazwaPolska();
        $program_id=$sylabus->getProgram()->getId();

        $rok_akademicki = $this->getDoctrine()->getRepository(Program::class)->find($program_id)->getRokAkademicki();
        $forma_studiow = $this->getDoctrine()->getRepository(Program::class)->find($program_id)->getFormaStudiow();
        $poziom_studiow = $this->getDoctrine()->getRepository(Program::class)->find($program_id)->getPoziomStudiow();

        $form = $this->createForm(SylabusType::class, $sylabus);
        dump($form);
        $form->handleRequest($request);
        dump($form);
        #$form_hour->handleRequest($request);

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        if ($form->isSubmitted() && $form->isValid())
        {

            $sylabus = $form->getData();
            #$godziny = $form_hour->getData();
            dump($sylabus);

            $entityManager->persist($sylabus);
            $entityManager->flush();

        }
        return $this->render('sylabus/sylabus.html.twig', [
            'form' => $form->createView(),
            'nazwa'=>$nazwa_zajec_polska,
            'rok_akademicki'=>$rok_akademicki,
            'poziom_studiow'=>$poziom_studiow,
            'forma_studiow'=>$forma_studiow,
        ]);
    }
}
