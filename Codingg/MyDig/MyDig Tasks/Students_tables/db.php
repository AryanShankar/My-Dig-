<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student_task";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and bind SQL statement for inserting into students table
    $sql1 = "INSERT INTO students (name) VALUES (?)";
    $stmt1 = mysqli_prepare($conn, $sql1);
    mysqli_stmt_bind_param($stmt1, "s", $name);
    
    // Prepare and bind SQL statement for inserting into contact_details table
    $sql2 = "INSERT INTO contact_details (phone_number, email) VALUES (?, ?)";
    $stmt2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt2, "ss", $phone_number, $email);

    // Escape user inputs for security
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Attempt to execute prepared statements
    if (mysqli_stmt_execute($stmt1) && mysqli_stmt_execute($stmt2)) {
        echo "Data added successfully.";
    } else {
        echo "ERROR: Could not able to execute prepared statements.";
    }

    // Close statements
    mysqli_stmt_close($stmt1);
    mysqli_stmt_close($stmt2);

    // Close connection
    mysqli_close($conn);
?>
