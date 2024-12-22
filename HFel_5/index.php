<?php

require_once "Student.php";
require_once "Subject.php";
require_once "University.php";

// University, Student-ek, Subject-ek létrehozása
$uni = new University();

$uni->addSubject("0123", "PHP");
$uni->addSubject("4567", "Python");
$uni->addSubject("7890", "Android");
$uni->addSubject("3123", "Web");

$stud1 = new Student("John Doe", "1234");
$stud2 = new Student("Jane Smith", "2345");
$stud3 = new Student("Kalaman Elek", "2347");
$stud4 = new Student("James Bond", "4562");

// Studentek hozzárendelese a Sebjectekhez
$uni->addStudentOnSubject("0123", $stud1);
$uni->addStudentOnSubject("7890", $stud1);
$uni->addStudentOnSubject("4567", $stud1);
$uni->addStudentOnSubject("3123", $stud1);
$uni->addStudentOnSubject("0123", $stud2);
$uni->addStudentOnSubject("7890", $stud2);
$uni->addStudentOnSubject("4567", $stud2);
$uni->addStudentOnSubject("7890", $stud3);
$uni->addStudentOnSubject("4567", $stud3);
$uni->addStudentOnSubject("3123", $stud4);

// Studentek, Subject törlése
($uni->subjects[3]->deleteStudent($stud1));
($uni->subjects[3]->deleteStudent($stud4));

$uni->deleteSubject($uni->subjects[3]);

$uni-> print();

// Osztályzatok hozzáadása, kiírása
$stud1->setGrade("0123", 10);
$stud1->setGrade("4567", 9);
$stud1->setGrade("7890", 10);

$stud2->setGrade("0123", 8);
$stud2->setGrade("4567", 7);
$stud2->setGrade("7890", 6);

$stud3->setGrade("4567", 9);
$stud3->setGrade("7890", 10);

echo "Hallgató átlaga:" . $stud1->getAvgGrade() . "<br>";

$stud1->printGrades();

//Rendezés átlagok szerint
$uni->orderByAvg();