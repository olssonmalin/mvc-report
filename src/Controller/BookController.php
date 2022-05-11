<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BookRepository;
use App\Entity\Book;
use Symfony\Component\Validator\Constraints\DateTime;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    /**
    * @Route("/book/add",
    *      name="add_book",
    *      methods={"GET"})
    */
    public function add(): Response
    {
        $title = "Add book";
        return $this->render('book/add.html.twig', [
            'title' => $title
        ]);
    }

    /**
    * @Route("/book/add",
    *      name="add_book_process",
    *      methods={"POST"})
    */
    public function addBookProcess(
        Request $request,
        ManagerRegistry $doctrine
        ): Response
    {
        $result =[
            "title" => $request->request->get("title"),
            "description" => $request->request->get("description"),
            "img" => $request->request->get("img"),
            "date" => $request->request->get("release")
        ];

        $entityManager = $doctrine->getManager();

        $book = new Book;
        $book->setTitle($request->request->get("title"));
        $book->setDescription($request->request->get("description"));
        $book->setImg($request->request->get("img"));
        $book->setAuthor($request->request->get("author"));
        $book->setReleaseDate($request->request->get("release"));
        $book->setISBN(intval($request->request->get("isbn")));
        $book->setCategory($request->request->get("category"));
        $book->setLanguage($request->request->get("language"));


        $entityManager->persist($book);

        $entityManager->flush($book);

        // return $this->json($result);
        return $this->redirectToRoute('book_show_all');

    }

    /**
    * @Route("/book/show", name="book_show_all")
    */
    public function showAllBooks(
        Bookrepository $bookRepository
    ): Response {
        $books = $bookRepository
            ->findAll();

        $title = "All books";
        
        // return $this->json($books);
        return $this->render('book/show-all.html.twig', [
            'title' => $title,
            'books' => $books
        ]);
    }

    /**
     * @Route("/book/show/{id}", defaults={"id" = 1}, name="book_by_id")
     */
    public function showBook(
        BookRepository $bookRepository,
        int $id
    ): Response {
        $book = $bookRepository
            ->find($id);
        
        
        // return $this->json($book);
        return $this->render('book/show-one.html.twig', [
            'book' => $book
        ]);
    }

    /**
     * @Route("/book/edit/{id}",
     *      defaults={"id" = 1}, 
     *      name="edit-book",
     *      methods={"GET"})
     */
    public function editBook(
        BookRepository $bookRepository,
        int $id
    ): Response {
        $book = $bookRepository
            ->find($id);
        
        $title = "Update";
        
        
        // return $this->json($book);
        return $this->render('book/update.html.twig', [
            'title' => $title,
            'book' => $book
        ]);
    }

    /**
     * @Route("/book/edit/{id}", defaults={"id" = 1}, name="edit-book-process",
     *      methods={"POST"})
     */
    public function editBookProcess(
        Request $request,
        BookRepository $bookRepository,
        ManagerRegistry $doctrine
    ): Response {

        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($request->request->get("id"));

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$request->request->get("id")
            );
        }

        $book->setTitle($request->request->get("title"));
        $book->setDescription($request->request->get("description"));
        $book->setImg($request->request->get("img"));
        $book->setAuthor($request->request->get("author"));
        $book->setReleaseDate($request->request->get("release"));
        $book->setISBN(intval($request->request->get("isbn")));
        $book->setCategory($request->request->get("category"));
        $book->setLanguage($request->request->get("language"));
        
        $entityManager->flush();

        $title = "Update";
        
        // return $this->json($book);
        return $this->redirectToRoute('book_by_id', ["id" => $request->request->get("id")]);
    }

    /**
     * @Route("/book/delete/{id}", name="delete-book")
     */
    public function deleteBook(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('book_show_all');
    }
}

