<?php 
include "config.php"; 
if (isset($_GET['id'])) {
    $emp_id = $_GET['id'];
    $sql = "DELETE FROM `emp` WHERE `emp_id`='$emp_id'";
    $result = $conn->query($sql);
    if ($result == TRUE) {
        session_start();
        $_SESSION['delete_message'] = "Record deleted successfully.";
        header("Location: read.php");
        exit();
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
} 
?>
