<?php
class ArrayManipulator {
    private $data = [];

    public function __construct($initialData) {
        if (is_array($initialData)) {
            $this->data = $initialData;
        }
    }

    public function __get($key) {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } else {
            return null; // vagy tetszőleges hibakezelési logika
        }
    }

    public function __set($key, $value) {
        $this->data[$key] = $value;
    }

    public function __isset($key) {
        return isset($this->data[$key]);
    }

    public function __unset($key) {
        unset($this->data[$key]);
    }
}


$myArray = new ArrayManipulator(['name' => 'Artur', 'age' => 35]);

// __get test
echo $myArray->name . '<br>';

// __set test
$myArray->city = 'Szereda <br>';

echo $myArray->city;

// __isset test
if (isset($myArray->age)) {
    echo " Age is set: $myArray->age. <br>";
} else {
    echo " Age is not set. <br>";
}

// __unset test
unset($myArray->age);

if (isset($myArray->age)) {
    echo "Age is set: $myArray->age. <br>.";
} else {
    echo "Age is not set. <br>";
}
?>