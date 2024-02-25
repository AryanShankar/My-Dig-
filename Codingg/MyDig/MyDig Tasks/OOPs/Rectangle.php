<?php

// Define a subclass Rectangle inheriting from Shape
class Rectangle extends Shape {
    private $length;
    private $width;

    // Constructor
    public function __construct($name, $length, $width) {
        parent::__construct($name);
        $this->length = $length;
        $this->width = $width;
    }

    // Method to calculate the area of the rectangle
    public function calculateArea() {
        return $this->length * $this->width;
    }
}

?>