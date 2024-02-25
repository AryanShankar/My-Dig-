<?php

// Define variables and initialize with empty values
$name = $number = $age = $gender = $jobRole = $uploadFile = '';
$errors = [];

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $errors[] = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    // Validate number
    if (empty($_POST["number"])) {
        $errors[] = "Number is required";
    } else {
        $number = test_input($_POST["number"]);
    }

    // Validate age
    if (empty($_POST["age"]) || !is_numeric($_POST["age"])) {
        $errors[] = "Age is required and should be a number";
    } else {
        $age = test_input($_POST["age"]);
    }

    // Validate gender
    if (empty($_POST["gender"])) {
        $errors[] = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    // Validate job role
    if (empty($_POST["jobRole"])) {
        $errors[] = "Job Role is required";
    } else {
        $jobRole = test_input($_POST["jobRole"]);
    }

    // File upload handling
    if ($_FILES["uploadFile"]["error"] == UPLOAD_ERR_OK) {
        $uploadFile = $_FILES["uploadFile"]["name"];
        move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $uploadFile);
    }

    // If no errors, save data to JSON file
    if (empty($errors)) {
        $userData = array(
            "Name" => $name,
            "Number" => $number,
            "Age" => $age,
            "Gender" => $gender,
            "Job Role" => $jobRole,
            "Uploaded File" => $uploadFile
        );

        $jsonUserData = json_encode($userData, JSON_PRETTY_PRINT);
        file_put_contents('user_data.json', $jsonUserData);
    }
}

// Function to sanitize input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
</head>

<body>
    <h2>User Form</h2>
    <?php
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
    ?>
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Name: <input type="text" name="name"><br><br>
        Number: <input type="text" name="number"><br><br>
        Age: <input type="text" name="age"><br><br>
        Gender:
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender" value="female">Female<br><br>
        Job Role:
        <select name="jobRole">
            <option value="">Select...</option>
            <option value="developer">Developer</option>
            <option value="designer">Designer</option>
            <option value="manager">Manager</option>
        </select><br><br>
        Upload File: <input type="file" name="uploadFile"><br><br>
        <input type="submit" name="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>

    <?php
    // Display submitted user data
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)) {
        echo "<h2>Submitted User Data:</h2>";
        echo "<pre>";
        print_r($userData);
        echo "</pre>";
    }
    ?>
</body>

</html>
