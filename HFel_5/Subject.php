<?php
/**
 * User: TheCodeholic
 * Date: 4/8/2020
 * Time: 10:16 PM
 */

/**
 * Class Subject
 */
class Subject
{
    private string  $code;
    private string $name;

    /**
     * @var Student[]
     */
    private array $students = [] ;

    public function getCode(){
        return $this->code;
    }

    public function setCode($code){
        $this->code = $code;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getStudents(){
        return $this->students;
    }

    public function setStudents($students){
        $this->students = $students;
    }

    public function __construct(string $code, string $name, array $students= []) {
        $this->code = $code;
        $this->name = $name;
        $this->students = $students;
    }

    /**
     * Method accepts student name and number, creates instance of the Student class, adds inside $students array
     * and returns created instance
     *
     * @param string $name
     * @param string $studentNumber
     * @return \Student
     */

    public function addStudent(string $name, string $studentNumber): Student {
        $existingStudent = $this->isStudentExists($studentNumber);

        if ($existingStudent) {
            throw new Exception('Már létezik hallgató .');
        }

        $student = new Student($name, $studentNumber);

        // Itt történik a hallgató hozzárendelése a tantárgyhoz
        $this->students[] = $student;

        return $student;
    }



    public function isStudentExists(string $studentNumber): bool {
        foreach ($this->students as $student) {
            if ($student->getStudentNumber() === $studentNumber) {
                return true;
            }
        }

        return false;
    }

    public function deleteStudent(Student $student): void {
        foreach ($this->students as $key => $studentKey) {
            if ($student == $studentKey) {
                unset($this->students[$key]);
                echo "Hallgató sikeresen törölve. <br>";
                return;
            }
        }

        echo "A hallgató nem található.<br>";
    }





    public function __toString(): string
    {
        return "Subject: Code - {$this->code}, Name - {$this->name}";
    }
}