<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * testcalss for Book class
 */
class BookObjectTest extends TestCase
{
    /**
     * Confirms instance of Book is created
     *
     * @return void
     */
    public function testCreateBook()
    {   
        $book = new Book();
        $this->assertInstanceOf("\App\Entity\Book", $book);
    }

    /**
     * Confirms set/get Title works
     * 
     */
    public function testSetGetTitle()
    {
        $book = new Book();
        $title = "Harry Potter";
        $book->setTitle($title);

        $this->assertEquals($book->getTitle(), $title);
    }

     /**
     * Confirms set/get ISBN works
     * 
     */
    public function testSetGetIsbn()
    {
        $book = new Book();
        $isbn = 1234567890;
        $book->setISBN($isbn);

        $this->assertEquals($book->getISBN(), $isbn);
    }

     /**
     * Confirms set/get author works
     * 
     */
    public function testSetGetAuthor()
    {
        $book = new Book();
        $author = "J.K Rowling";
        $book->setAuthor($author);

        $this->assertEquals($book->getAuthor(), $author);
    }

     /**
     * Confirms set/get description works
     * 
     */
    public function testSetGetDescription()
    {
        $book = new Book();
        $description = "Harry potter och hans vänner.......";
        $book->setDescription($description);

        $this->assertEquals($book->getDescription(), $description);
    }

     /**
     * Confirms set/get ReleaseDate works
     * 
     */
    public function testSetGetReleaseDate()
    {
        $book = new Book();
        $releaseDate = "2001-01-01";
        $book->setReleaseDate($releaseDate);

        $this->assertEquals($book->getReleaseDate()->format('Y-m-d'), $releaseDate);
    }


     /**
     * Confirms set/get Img works
     * 
     */
    public function testSetGetImg()
    {
        $book = new Book();
        $img = "/img/harry-potter.png";
        $book->setImg($img);

        $this->assertEquals($book->getImg(), $img);
    }

     /**
     * Confirms set/get Category works
     * 
     */
    public function testSetGetCategory()
    {
        $book = new Book();
        $category = "Ungdom";
        $book->setCategory($category);

        $this->assertEquals($book->getCategory(), $category);
    }

     /**
     * Confirms set/get Language works
     * 
     */
    public function testSetGetLanguage()
    {
        $book = new Book();
        $language = "Svenska";
        $book->setLanguage($language);

        $this->assertEquals($book->getLanguage(), $language);
    }
}