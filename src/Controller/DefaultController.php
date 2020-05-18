<?php

namespace App\Controller;

use App\Entity\Sylabus;
use App\Security\Voter\EditSylabusVoter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/test", name="testVotera")
     */
    public function testVotera()
    {
        $sylabus = $this->getDoctrine()
            ->getRepository(Sylabus::class)
            ->findOneByNumerKatalogowy('ZIM-IN-2S-04L-31');

        $this->denyAccessUnlessGranted(EditSylabusVoter::SYLABUS_EDIT, $sylabus);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
