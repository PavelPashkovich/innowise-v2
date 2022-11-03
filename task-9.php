<?php

class Student
{
    private string $firstName;
    private string $lastName;
    private string $group;
    private float $averageMark;

    public function __construct(string $firstName, string $lastName, string $group, float $averageMark)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->group = $group;
        $this->averageMark = $averageMark;
    }

    public function __get(string $property)
    {
        $properties = ['firstName', 'lastName', 'group', 'averageMark'];
        if (in_array($property, $properties)) {
            return $this->$property;
        }
    }

    public function getFullName(): string {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getScholarship(): string {
        $fullName = $this->getFullName();
        return $this->averageMark == 5 ? "Scholarship of $fullName is 100 USD." : "Scholarship of $fullName is 80 USD.";
    }
}

class Aspirant extends Student
{
    private string $researchWork;

    public function __construct(string $firstName, string $lastName, string $group, float $averageMark, string $researchWork)
    {
        parent::__construct($firstName, $lastName, $group, $averageMark);
        $this->researchWork = $researchWork;
    }

    public function __get(string $property)
    {
        if ($property == 'researchWork') {
            return $this->$property;
        }
        return parent::__get($property);
    }

    public function getScholarship(): string {
        $fullName = $this->getFullName();
        return $this->averageMark == 5 ? "Scholarship of $fullName is 200 USD." : "Scholarship of $fullName is 180 USD.";
    }
}

$student1 = new Student('John', 'Connor', 'T-1000', 5);
$student2 = new Student('Sara', 'Connor', 'T-1000', 4.8);
$student3 = new Student('Thomas', 'A. Anderson', 'Matrix', 4.3);
$student4 = new Student('Bruce', 'Wayne', 'Gotham', 4.5);

$aspirant1 = new Aspirant('Winter', 'Soldier', 'Marvel', 4.2, 'Civil War');
$aspirant2 = new Aspirant('Iron', 'Man', 'Marvel', 5, 'Avengers');
$aspirant3 = new Aspirant('Bat', 'Man', 'DC', 5, 'Dark Knight');
$aspirant4 = new Aspirant('Super', 'Man', 'DC', 5, 'Krypton');

$students = [$student1, $aspirant1, $student2, $aspirant2, $student3, $aspirant3, $student4, $aspirant4];
foreach ($students as $student) {
    echo $student->getScholarship() . "\n";
}
