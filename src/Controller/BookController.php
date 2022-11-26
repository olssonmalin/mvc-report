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
     * Set book attributes for edit/add book
     *
     * @param Book $book
     * @param string $title
     * @param string $description
     * @param string $img
     * @param string $author
     * @param string $release
     * @param string $isbn
     * @param string $category
     * @param string $language
     * @return void
     */
    public function setBookAttr(
        Book $book, 
        string $title,
        string $description,
        string $img,
        string $author,
        string $release,
        string $isbn,
        string $category,
        string $language
    ): void {
        $book->setTitle($title);
        $book->setDescription($description);
        $book->setImg($img);
        $book->setAuthor($author);
        $book->setReleaseDate($release);
        $book->setISBN($isbn);
        $book->setCategory($category);
        $book->setLanguage($language);
    }

    /**
    * @Route("/book/add",
    *      name="add_book_process",
    *      methods={"POST"})
    */
    public function addBookProcess(
        Request $request,
        ManagerRegistry $doctrine
    ): Response {

        $entityManager = $doctrine->getManager();

        $book = new Book();
        $this->setBookAttr(
            $book,
            $request->request->get("title"),
            $request->request->get("description"),
            $request->request->get("img"),
            $request->request->get("author"),
            $request->request->get("release"),
            $request->request->get("isbn"),
            $request->request->get("category"),
            $request->request->get("language")
        );
        // $book->setTitle($request->request->get("title"));
        // $book->setDescription($request->request->get("description"));
        // $book->setImg($request->request->get("img"));
        // $book->setAuthor($request->request->get("author"));
        // $book->setReleaseDate($request->request->get("release"));
        // $book->setISBN($request->request->get("isbn"));
        // $book->setCategory($request->request->get("category"));
        // $book->setLanguage($request->request->get("language"));

        $entityManager->persist($book);

        $entityManager->flush();

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
     * @Route("/book/show/{id}", defaults={"id" = 1}, name="book_by_id", methods={"GET"})
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
        ManagerRegistry $doctrine
    ): Response {

        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($request->request->get("id"));

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id ' . $request->request->get("id")
            );
        }

        $this->setBookAttr(
            $book,
            $request->request->get("title"),
            $request->request->get("description"),
            $request->request->get("img"),
            $request->request->get("author"),
            $request->request->get("release"),
            $request->request->get("isbn"),
            $request->request->get("category"),
            $request->request->get("language")
        );

        // $book->setTitle($request->request->get("title"));
        // $book->setDescription($request->request->get("description"));
        // $book->setImg($request->request->get("img"));
        // $book->setAuthor($request->request->get("author"));
        // $book->setReleaseDate($request->request->get("release"));
        // $book->setISBN($request->request->get("isbn"));
        // $book->setCategory($request->request->get("category"));
        // $book->setLanguage($request->request->get("language"));

        $entityManager->flush();

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
                'No book found for id ' . $id
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('book_show_all');
    }
}
