<?php
require_once "AbstractUniversity.php";

class University extends AbstractUniversity{

    private $allStudents = [];

    public function addSubject(string $code, string $name): Subject {

        foreach ($this->subjects as $existingSubject) {
            if ($existingSubject->getCode() == $code) {

                if (!in_array($existingSubject, $this->subjects, true)) {
                    $this->subjects[] = $existingSubject;
                }
                return $existingSubject;
            }
        }

        $subject = new Subject($code, $name);
        $this->subjects[] = $subject;


        return $subject;
    }


    public function addStudentOnSubject(string $subjectCode, Student $student) {
        $subject = null;

        // Keresd meg a megfelelő tantárgyat a kód alapján
        foreach ($this->subjects as $subj) {
            if ($subj->getCode() === $subjectCode) {
                $subject = $subj;
                break;
            }
        }

        if ($subject === null) {
            throw new Exception('Subject with code ' . $subjectCode . ' does not exist.');
        }

        // Add hozzá a hallgatót a tantárgyhoz
        $subject->addStudent($student->getName(), $student->getStudentNumber());
        $this->allStudents[] = $student;
    }


    public function getStudentsForSubject(string $subjectCode) {
        $subject = null;
        foreach ($this->subjects as $subj) {
            if ($subj->getCode() === $subjectCode) {
                $subject = $subj;
                break;
            }
        }

        if ($subject === null) {
            return [];
        }

        return $subject->getStudents();
    }

    public function getNumberOfStudents(): int{
        $studentCount = 0;

        foreach ($this->subjects as $subject) {
            $studentCount += count($subject->getStudents());
        }

        return $studentCount;
    }

    public function print() {
        foreach ($this->subjects as $subject) {
            $subjectCode = $subject->getCode();
            $subjectName = $subject->getName();
            $studentCount = count($subject->getStudents());

            echo "Tantárgy kódja: $subjectCode<br>";
            echo "Tantárgy neve: $subjectName<br>";
            echo "Feliratkozott diákok száma: $studentCount<br>";
            echo "<br>";
        }
    }

    public function deleteSubject(Subject $subject){
        $studentsCount = count($subject->getStudents());

        if ($studentsCount === 0) {
            $index = array_search($subject, $this->subjects, true);
            if ($index !== false) {
                unset($this->subjects[$index]);
                $this->subjects = array_values($this->subjects); // Re-index the array
                echo "Kurzus sikeresen törölve. <br>";
                return;
            } else {
                throw new Exception('Kurzus nem található.');
            }
        } else {
            throw new Exception('Nem törölhető. Még van hallgató hozzáadva a kurzushoz.');
        }
    }

    public function orderByAvg() {
        // Készítsünk egy segédváltozót az átlagok tárolására
        $avgGrades = [];

        // Számoljuk ki az átlagokat és tároljuk azokat egy asszociatív tömbben
        foreach ($this->allStudents as $student) {
            $avgGrades[$student->getName()] = $student->getAvgGrade();
        }

        // Rendezzük az átlagok alapján az asszociatív tömböt
        arsort($avgGrades);

        // Kiírjuk és összeállítjuk a rendezett hallgatók listáját
        $orderedStudents = [];
        foreach ($avgGrades as $name => $avgGrade) {
            echo $name . ' átlaga: ' . $avgGrade . "<br>";
            foreach ($this->allStudents as $student) {
                if ($student->getName() === $name) {
                    $orderedStudents[] = $student;
                    break;
                }
            }
        }

        // Visszaadjuk a rendezett hallgatók listáját
        return $orderedStudents;
    }


}