<?php

include 'Rectangle.php';
include 'Circle.php';

// Define a base class Shape
class Shape {
    protected $name;

    // Constructor
    public function __construct($name) {
        $this->name = $name;
    }

    // Method to get the name of the shape
    public function getName() {
        return $this->name;
    }
}

?>
