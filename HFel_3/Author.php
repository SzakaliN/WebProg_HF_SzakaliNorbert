<?php

class Author
{
    private string $name;
    private $books = [];

    public function __construct($name) {
        $this->name = $name;
        $this->books = [];
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getBook(){
        return $this->books;
    }

    public function setBook($books){
        $this->books = $books;
    }

    /**
     * @param string $title
     * @param float  $price
     * @return \Book
     */
    public function addBook(string $title, float $price): Book{
        return $book =  $this->books[] = new Book($title, $price, $this);
    }
}