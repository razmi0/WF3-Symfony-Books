<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book', name: 'book:')]
class BookController extends AbstractController
{
    #[Route('s', name : 'index', methods : ["HEAD", "GET", "POST"])]
    public function index(BookRepository $bookRepository): Response
    {

        $books = $bookRepository->findAll();

        return $this->render('pages/book/index.html.twig', [
            'books' => $books,
        ]);
    }
    #[Route('', name: 'create')]
    public function create(Request $request, BookRepository $bookRepository): Response
    {
        // Auth ? 

        //Create obj Book
        $book = new Book;

        //Build the form sur l'architecture de Booktype(form) 
        // et selon obj $book

        $form = $this->createForm(BookType::class, $book);

        //Handle the form
        $form->handleRequest($request);

        // form treatment + form validator + saving data

        if ($form->isSubmitted() && $form->isValid()) {

            $bookRepository->save($book, true);

            return $this->redirectToRoute('book:read', [
                'id' => $book->getId()
            ]);

        }


        // create form view 

        $form = $form->createView();


        return $this->render('pages/book/create.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/{id}', name: 'read' , methods : ["HEAD", "GET"])]
    public function read(Book $book): Response
    {

        return $this->render('pages/book/read.html.twig', [
            'book' => $book
        ]);
    }
    #[Route('/{id}/edit', name: 'update', methods : ["HEAD", "GET", "POST"])]
    public function update(Book $book, Request $request, BookRepository $bookRepository): Response
    {
                //Build the form sur l'architecture de Booktype(form) 
        // et selon obj $book

        $form = $this->createForm(BookType::class, $book);

        //Handle the form
        $form->handleRequest($request);

        // form treatment + form validator + saving data

        if ($form->isSubmitted() && $form->isValid()) {

            $bookRepository->save($book, true);

            return $this->redirectToRoute('book:read', [
                'id' => $book->getId()
            ]);

        }


        // create form view 

        $form = $form->createView();

        return $this->render('pages/book/update.html.twig', [
            'book' => $book,
            'form' => $form
        ]);
    }
    #[Route('/{id}/delete', name: 'delete')]
    public function delete(): Response
    {
        return $this->render('pages/book/delete.html.twig', [
        ]);
    }
}