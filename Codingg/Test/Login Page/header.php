<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="./styles/styles.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>LOGIN PAGE</title>

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav mr-auto">

          <?php
            if(isset($_SESSION["useruid"])){
              echo "<li class='nav-item'><a class='nav-link' href='home.php'>HOME</a></li>";
              echo "<li class='nav-item'><a class='nav-link' href='#'>PROFILE PAGE</a></li>";
              echo "<li class='nav-item ml-auto'><a class='nav-link' href='./includes/logout.php'>LOGOUT</a></li>";
            }
            else{
              echo "<li class='nav-item'><a class='nav-link' href='home.php'>HOME</a></li>";
              echo "<li class='nav-item'><a class='nav-link' href='login.php'>LOGIN</a></li>";
              echo "<li class='nav-item'><a class='nav-link' href='signup.php'>SIGNUP</a></li>";
            }
          ?>

        </ul>
    </nav>


    
    