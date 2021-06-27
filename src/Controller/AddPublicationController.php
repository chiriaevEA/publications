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
            $form = $form->getData();
            $doctrine = $this->getDoctrine();
            $entityManager = $doctrine->getManager();
            $publisher = 1;
#            $publisher = $doctrine->getRepository(Publisher::class)->findOneBy(['name' => $form['publisher']]);
            $author = $doctrine->getRepository(Author::class)->findOneBy([
                'first_name' => $form['first_name'],
                'second_name' => $form['second_name'],
            ]);
            $city = $doctrine->getRepository(City::class)->findOneBy(['name' => $form['city']]);
#            $type = $doctrine->getRepository(Type::class)->findOneBy(['name' => $form['type']]);
            $type = 2;
            if (!$author){
                $author = new Author;
                $author->setFirstName($form['first_name']);
                $author->setSecondName($form['second_name']);
                addEntity($entityManager, $author);
            }
            if (!$city){
                $city = new City;
                $city->setName($form['city']);
                addEntity($entityManager, $city);
            }
            if (!$publisher){
                $publisher = new Publisher();
                $publisher->setName($form['publisher']);
                addEntity($entityManager, $publisher);
            }
            $publication = new Publication;
            $publication->setName($form['name']);
            $publication->setDoi($form['doi']);
            $publication->setYear($form['year']);
            $publication->setPages($form['pages']);
#            $publication->setType($type->getId());
            $publication->addAuthor($author);
            $publication->setPublisher($publisher->getId());
            $publication->setCity($city->getId());
            addEntity($entityManager, $publication);
        }
        return $this->render('add_publication/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
