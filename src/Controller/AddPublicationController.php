<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Type;
use App\Entity\Author;
use App\Entity\Publisher;
use App\Entity\Publication;
use App\Form\PublicationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddPublicationController extends AbstractController
{
    /**
     * @Route("/add/publication", name="add_publication")
     */
    public function add(Request $request): Response
    {
        $form = $this->createForm(PublicationType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            function addEntity($entityManager, $entity){
                $entityManager->persist($entity);
                $entityManager->flush();
            }
            $data = $form->getData();
            $doctrine = $this->getDoctrine();
            $entityManager = $doctrine->getManager();
            $publisher = $doctrine->getRepository(Publisher::class)->findOneBy(['name' => $data['publisher']]);
            $author = $doctrine->getRepository(Author::class)->findOneBy([
                'first_name' => $data['first_name'],
                'second_name' => $data['second_name'],
            ]);
            $city = $doctrine->getRepository(City::class)->findOneBy(['name' => $data['city']]);
            $type = $doctrine->getRepository(Type::class)->findOneBy(['name' => $data['type']]);
            if (!$author){
                $author = new Author;
                $author->setFirstName($data['first_name']);
                $author->setSecondName($data['second_name']);
                addEntity($entityManager, $author);
            }
            if (!$city){
                $city = new City;
                $city->setName($data['city']);
                addEntity($entityManager, $city);
            }
            if (!$publisher){
                $publisher = new Publisher();
                $publisher->setName($data['publisher']);
                addEntity($entityManager, $publisher);
            }
            $publication = new Publication;
            $publication->setName($data['name']);
            $publication->setDoi($data['doi']);
            $publication->setYear($data['year']);
            $publication->setPages($data['pages']);
            $publication->setType($type);
            $publication->addAuthor($author);
            $publication->setPublisher($publisher);
            $publication->setCity($city);
            addEntity($entityManager, $publication);
        }
        return $this->render('add_publication/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
