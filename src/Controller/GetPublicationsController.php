<?php

namespace App\Controller;
use App\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetPublicationsController extends AbstractController
{
    /**
     * @Route("/get/publication", name="get_publications")
     */
    public function index(): Response
    {
        $pubs = $this->getDoctrine()->getRepository(Publication::class)->findAll();
        return $this->render('get_publications/index.html.twig', [
		'publications' => $pubs,
	]);
    }
    /*
        return $this->render('get_publications/index.html.twig', [
            'controller_name' => 'GetPublicationsController',
        ]);
        */
}
