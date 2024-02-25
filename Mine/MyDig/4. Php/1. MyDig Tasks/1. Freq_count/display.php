<!DOCTYPE html>
<html>
<head>
    <title>Display Person Details</title>
</head>
<body>
    <h2>Person Details</h2>
    <?php
    // Include the second PHP file
    $recieve = include 'details.php';
    echo "{$recieve} <br>";

    // Retrieve the function in the second PHP file
    $additional_info = getAdditionalInfo();
    
    // Display person details
    foreach ($person_details as $key => $value) {
        echo "<strong>$key:</strong> $value <br>";
    }

    // Display additional function info
    echo "<strong>Additional Info:</strong> $additional_info";
    ?>
</body>
</html>


