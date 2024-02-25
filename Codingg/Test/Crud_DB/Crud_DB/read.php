<?php
include "config.php";
session_start();
$delete_message = isset($_SESSION['delete_message']) ? $_SESSION['delete_message'] : null;
unset($_SESSION['delete_message']); // Clear the session variable
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Employees</h2>
        <?php if ($delete_message): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $delete_message; ?>
            </div>
        <?php endif; ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Job Role</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM emp";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $row['emp_id']; ?></td>
                            <td><?php echo $row['emp_name']; ?></td>
                            <td><?php echo $row['emp_job_role']; ?></td>
                            <td><?php echo $row['emp_email']; ?></td>
                            <td><a class="btn btn-info" href="update.php?id=<?php echo $row['emp_id']; ?>">Update</a>&nbsp;<a class="btn btn-danger" href="delete.php?id=<?php echo $row['emp_id']; ?>">Delete</a></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <form action="create.php">
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</body>

</html>
