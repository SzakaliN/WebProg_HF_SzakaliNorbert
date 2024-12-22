<?php

namespace LibraryNamespace;

class Library extends AbstractLibrary {

    public function getAuthor() {
        return $this->authors;
    }

    public function setAuthor($authors){
        $this->authors = $authors;
    }

    public function addAuthor($authorName): Author {
        foreach ($this->authors as $author) {
            if ($author->getName() === $authorName) {
                return $author;
            }
        }
        $newAuthor = new Author($authorName);
        $this->authors[] = $newAuthor;
        return $newAuthor;
    }

    public function addBookForAuthor($authorName, Book $book) {
        $author = $this->addAuthor($authorName);
        $author->addBook($book->getTitle(), $book->getPrice());
    }


    public function getBooksForAuthor($authorName){
        $books = [];

        foreach ($this->authors as $author) {
            if ($author->getName() === $authorName) {
                foreach ($author->getBook() as $book) {
                    $books[] = $book;
                }
            }
        }

        return $books;
    }

    public function search(string $query): array {
        $matchingBooks = [];

        foreach ($this->authors as $author) {
            foreach ($author->getBook() as $book) {
                if (strpos($book->getTitle(), $query) !== false || strpos($author->getName(), $query) !== false) {
                    $matchingBooks[] = $book;
                }
            }
        }

        return $matchingBooks;
    }

    public function print() {
        $authors = $this->getAuthor();

        foreach ($authors as $author) {
            echo $author->getName() . "<br>";
            echo "--------------------<br>";

            $books = $author->getBook();
            foreach ($books as $book) {
                echo $book->getTitle() . " - " . $book->getPrice() . "<br>";
            }

            echo "<br>";
        }
    }
    // TODO Implement all the methods declared in AbstractLibrary class

}

// $library = new Library();

// $author1 = $library->addAuthor("J.K. Rowling");
// $author2 = $library->addAuthor("George Orwell");
// $author3 = $library->addAuthor("George R. R. Martin");
// $author4 = $library->addAuthor("Stephen King");

// $book1 = new Book("Harry Potter and the Sorcerer's Stone", 50);
// $book2 = new Book("Harry Potter and the Chamber of Secrets", 50);
// $book3 = new Book("Harry Potter and the Prisoner of Azkaban", 50);
// $book4 = new Book("1984", 70);
// $book5 = new Book("Song of Ice and Fire", 30);
// $book6 = new Book("The Shining", 40);
// $book7 = new Book("The Stand", 40);

// $library->addBookForAuthor($author1->getName(), $book1);
// $library->addBookForAuthor($author1->getName(), $book2);
// $library->addBookForAuthor($author1->getName(), $book3);
// $library->addBookForAuthor($author2->getName(), $book4);
// $library->addBookForAuthor($author3->getName(), $book5);
// $library->addBookForAuthor($author4->getName(), $book6);
// $library->addBookForAuthor($author4->getName(), $book7);

// Print the list of authors and their books
// echo "Könyvtárban található szerzők és könyveik:<br>";
// foreach ($library->getAuthors() as $author) {
//     echo $author->getName() . ":<br>";
//     foreach ($author->getBook() as $book) {
//         echo "  - " . $book->getTitle() . ", Ár: $" . $book->getPrice() . "<br>";
//     }
// }

// $booksForAuthor = $library->getBooksForAuthor("J.K. Rowling");

// echo "Könyvek szerzője: " . $author1->getName() . " <br>";
// foreach ($booksForAuthor as $book) {
//     echo "  - " . $book->getTitle() . "<br>";
// }

// $matchingBooks = $library->search("Harry Potter");

// echo "Keresés eredménye a(z) " . 'Harry Potter' . " címre:<br>";
// foreach ($matchingBooks as $book) {
//     echo "  - Cím: " . $book->getTitle() . ", Szerző: " . $book->getAuthor()->getName() .", Ár: $" .$book->getPrice() ."<br>";
// }

// $library->print();