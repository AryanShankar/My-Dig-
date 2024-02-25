<?php
include "config.php";
if (isset($_POST["submit"])) {
    $emp_id = $_POST["id"];
    $emp_name = $_POST["name"];
    $emp_job_role = $_POST["role"];
    $emp_email = $_POST["email"];
    $sql = "INSERT INTO `emp`(`emp_id`, `emp_name`, `emp_job_role`, `emp_email`) VALUES ('$emp_id','$emp_name','$emp_job_role','$emp_email')";
    $result = $conn->query($sql);
    if ($result == TRUE) {

        echo "New record created successfully.";
    } else {

        echo "Error:" . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>
<body>
    <h2>Employee Form</h2>
    <form action="" method="POST">
        <fieldset>
            <legend>Create Emp details:</legend>
            employee id:<br>
            <input type="text" name="id" required>
            <br>
            employee name:<br>
            <input type="text" name="name" required>
            <br>
            employee job role:<br>
            <input type="text" name="role" required>
            <br>
            employee email:<br>
            <input type="text" name="email" required>
            <br><br>
            <input type="submit" name="submit" value="submit">
        </fieldset>
    </form>
</body>
</html>