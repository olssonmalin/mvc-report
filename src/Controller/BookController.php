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
     * @param mixed $title
     * @param mixed $description
     * @param mixed $img
     * @param mixed $author
     * @param mixed $release
     * @param mixed $isbn
     * @param mixed $category
     * @param mixed $language
     * @return void
     */
    public function setBookAttr(
        Book $book,
        mixed $title,
        mixed $description,
        mixed $img,
        mixed $author,
        mixed $release,
        mixed $isbn,
        mixed $category,
        mixed $language
    ): void {
        $book->setTitle($title);
        $book->setDescription($description);
        $book->setImg($img);
        $book->setAuthor($author);
        $book->setReleaseDate($release);
        $book->setISBN(intval($isbn));
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
     * @Route("/book/show/{bookId}", defaults={"bookId" = 1}, name="book_by_id", methods={"GET"})
     */
    public function showBook(
        BookRepository $bookRepository,
        int $bookId
    ): Response {
        $book = $bookRepository
            ->find($bookId);


        // return $this->json($book);
        return $this->render('book/show-one.html.twig', [
            'book' => $book
        ]);
    }

    /**
     * @Route("/book/edit/{bookId}",
     *      defaults={"bookId" = 1},
     *      name="edit-book",
     *      methods={"GET"})
     */
    public function editBook(
        BookRepository $bookRepository,
        int $bookId
    ): Response {
        $book = $bookRepository
            ->find($bookId);

        $title = "Update";


        // return $this->json($book);
        return $this->render('book/update.html.twig', [
            'title' => $title,
            'book' => $book
        ]);
    }

    /**
     * @Route("/book/edit/{bookId}", defaults={"bookId" = 1}, name="edit-book-process",
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

        $entityManager->flush();

        // return $this->json($book);
        return $this->redirectToRoute('book_by_id', ["bookId" => $request->request->get("id")]);
    }

    /**
     * @Route("/book/delete/{bookId}", name="delete-book")
     */
    public function deleteBook(
        ManagerRegistry $doctrine,
        int $bookId
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($bookId);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id ' . $bookId
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('book_show_all');
    }
}
