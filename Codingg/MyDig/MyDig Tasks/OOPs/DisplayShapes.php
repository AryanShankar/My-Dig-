<?php

include 'Shape.php';

// Displaying HTML form to get user input
echo '<form method="POST" action="DisplayShapes.php">
    Enter the name of the shape: <input type="text" name="name"><br>
    Enter the length/width/radius: <input type="text" name="dimension"><br>
    <input type="submit" value="Submit">
</form>';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $dimension = $_POST['dimension'];

    // Parsing dimension
    $parts = explode(",", $dimension);
    $length = $parts[0];
    $width = isset($parts[1]) ? $parts[1] : null;
    $radius = isset($parts[2]) ? $parts[2] : null;

    // Creating objects based on user input
    if ($length && $width) {
        $rectangle = new Rectangle($name, $length, $width);
        echo "Rectangle: " . $rectangle->getName() . "<br>";
        echo "Area: " . $rectangle->calculateArea() . "<br>";
    } elseif ($radius) {
        $circle = new Circle($name, $radius);
        echo "Circle: " . $circle->getName() . "<br>";
        echo "Area: " . $circle->calculateArea() . "<br>";
    } else {
        echo "Invalid input!";
    }
}

?>
