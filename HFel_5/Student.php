<?php

class Student
{
    private string $name;
    private string $studentNumber;
    private array $grades;

    public function __construct($name, $studentNumber) {
        $this->name = $name;
        $this->studentNumber = $studentNumber;
        $this->grades = []; // Initializing an empty grades array
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getStudentNumber() {
        return $this->studentNumber;
    }

    public function setStudentNumber($studentNumber){
        $this->studentNumber = $studentNumber;
    }

    public function getGrades() {
        return $this->grades;
    }


    public function setGrade($courseCode, $grade) {
        $this->grades[$courseCode] = $grade;
    }




    public function getAvgGrade() {
        $average = 0.0;

        if (count($this->grades) > 0) {
            $sum = array_sum($this->grades);
            $average = $sum / count($this->grades);
        }

        return $average;
    }



    public function printGrades() {
        echo "$this->name jegyei: <br>";
        foreach ($this->grades as $courseCode => $grade) {
            echo "$courseCode – $grade" . PHP_EOL ."<br>" ;
        }
    }
}