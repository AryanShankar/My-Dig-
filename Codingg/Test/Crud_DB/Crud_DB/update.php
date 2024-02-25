<?php
include "config.php";
if (isset($_POST['update'])) {
    $emp_id = $_POST['id'];
    $emp_name = $_POST['name'];
    $emp_job_role = $_POST['role'];
    $emp_email = $_POST['email'];
    $sql = "UPDATE `emp` SET `emp_name`='$emp_name', `emp_job_role`='$emp_job_role', `emp_email`='$emp_email' WHERE `emp_id`='$emp_id'";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
} else {
    if (isset($_GET['id'])) {
        $emp_id = $_GET['id'];
        $sql = "SELECT * FROM `emp` WHERE `emp_id`='$emp_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $emp_name = $row['emp_name'];
                $emp_email = $row['emp_email'];
                $emp_job_role = $row['emp_job_role'];
                $emp_id = $row['emp_id'];
            }
        } else {
            header('Location: read.php');
            exit(); 
        }
    } else {
        header('Location: read.php');
        exit(); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
    <h2>User Update Form</h2>

    <form action="" method="post">

        <fieldset>

            <legend>Employee Details:</legend>

            Employee name:<br>
            <input type="text" name="name" value="<?php echo $emp_name; ?>">
            <input type="hidden" name="id" value="<?php echo $emp_id; ?>">
            <br>
            Job Role:<br>
            <input type="text" name="role" value="<?php echo $emp_job_role; ?>">
            <br>
            Email:<br>
            <input type="email" name="email" value="<?php echo $emp_email; ?>">
            <br><br>
            <input type="submit" value="Update" name="update">

        </fieldset>

    </form> 

</body>
</html>
