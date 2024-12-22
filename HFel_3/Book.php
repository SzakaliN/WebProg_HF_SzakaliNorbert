<?php


class Book
{
    private string $title;
    private float $price;
    private Author $author;

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getPrice(){
        return $this->price;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function setAuthor($author){
        $this->author = $author;
    }

    public function __construct($title, $price, $author = null){
        $this->title = $title;
        $this->price = $price;
        if ($author != null){
            $this->author = $author;
        }
    }

}