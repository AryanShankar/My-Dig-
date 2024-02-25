<?php
    if(isset($_POST["submit"])){
        
        $name = $_POST["name"];
        $email = $_POST["email"];
        $username = $_POST["uid"];
        $pwd = $_POST["pwd"];
        $pwdRepeat = $_POST["pwdrepeat"];

        require_once 'db.php';
        require_once 'functions.php';

        if(emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false){
            header("location: ../signup.php?error=emptyinput");
            exit();
        }
        if(invalidEmail($email) !== false){
            header("location: ../signup.php?error=invalidemail");
            exit();
        }
        if(invalidUid($username) !== false){
            header("location: ../signup.php?error=invaliduid");
            exit();
        }
        if(pwdMatch($pwd, $pwdRepeat) !== false){
            header("location: ../signup.php?error=passwordsdontmatch");
            exit();
        }
        if(uidExists($conn, $username, $email) !== false){
            header("location: ../signup.php?error=usernametaken");
            exit();
        }

        createUser($conn, $name, $email, $username, $pwd);


    }
    else{
        header("location: ../signup.php?error");
    }

?>