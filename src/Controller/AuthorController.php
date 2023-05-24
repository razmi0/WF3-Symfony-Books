<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/author', name: 'author:')]
class AuthorController extends AbstractController
{
    #[Route('s', name: 'index', methods: ["HEAD", "GET", "POST"])]
    public function index(AuthorRepository $authorRepository): Response
    {
        // Requete DQL de récup de la liste des livres en BDD
        $authors = $authorRepository->findAll();

        // Rendu de la page dédiée à l'affichage de la liste des livres
        // en passant la variable $authors contenant la liste des livres de la BDD
        return $this->render('pages/author/index.html.twig', [
            'authors' => $authors
        ]);
    }

    #[Route('', name: 'create', methods: ["HEAD", "GET", "POST"])]
    public function create(Request $request, AuthorRepository $authorRepository): Response
    {
        // Auth ? 

        //Create obj author
        $author = new Author;

        //Build the form sur l'architecture de Booktype(form) 
        // et selon obj $author

        $form = $this->createForm(AuthorType::class, $author);

        //Handle the form
        $form->handleRequest($request);

        // form treatment + form validator + saving data

        if ($form->isSubmitted() && $form->isValid()) {

            $authorRepository->save($author, true);

            return $this->redirectToRoute('author:read', [
                'id' => $author->getId()
            ]);

        }


        // create form view 

        $form = $form->createView();


        return $this->render('pages/author/create.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/{id}', name: 'read', methods: ["HEAD", "GET"])]
    public function read(Author $author): Response
    {

        return $this->render('pages/author/read.html.twig', [
            'author' => $author
        ]);
    }
    #[Route('/{id}/edit', name: 'update', methods: ["HEAD", "GET", "POST"])]
    public function update(Author $author, Request $request, AuthorRepository $authorRepository): Response
    {
        //Build the form sur l'architecture de Booktype(form) 
        // et selon obj $book

        $form = $this->createForm(AuthorType::class, $author);

        //Handle the form
        $form->handleRequest($request);

        // form treatment + form validator + saving data

        if ($form->isSubmitted() && $form->isValid()) {
            $authorRepository->save($author, true);

            return $this->redirectToRoute('author:read', [
                'id' => $author->getId()
            ]);

        }


        // create form view 

        $form = $form->createView();

        return $this->render('pages/author/update.html.twig', [
            'author' => $author,
            'form' => $form
        ]);
    }
    #[Route('/{id}/delete', name: 'delete')]
    public function delete(): Response
    {
        return $this->render('pages/author/delete.html.twig', [
        ]);
    }
    
}
