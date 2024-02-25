<?php

// Define a subclass Circle inheriting from Shape
class Circle extends Shape {
    private $radius;

    // Constructor
    public function __construct($name, $radius) {
        parent::__construct($name);
        $this->radius = $radius;
    }

    // Method to calculate the area of the circle
    public function calculateArea() {
        return M_PI * $this->radius * $this->radius;
    }
}

?>