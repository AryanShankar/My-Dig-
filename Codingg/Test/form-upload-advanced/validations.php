<?php

    $name_valid = $phone_valid = $email_valid = $file_valid = false;

    function testData($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function validateName($name){
        global $name_valid;
        $name = testData($name);
        if(empty($name)){
            echo "Please Enter your name <br>";
        }
        else if(!preg_match("/^[a-zA-Z' -]+$/", $name)){
            echo "First name must contain only letters, hyphens, and apostrophes <br>";
        }
        else{
            $name_valid = true;
        }
    }

    function validatePhone($phone){
        global $phone_valid;
        if(empty($phone)){
            echo "Please enter your phone number <br>";
        }
        else if(!preg_match("/^\d{10}$/", $phone)){
            echo "Phone number should contain only digits and should be of 10 digits <br>";
        }
        else{
            $phone_valid = true;
        }
    }

    function validateEmail($email){
        global $email_valid;
        if(empty($email)){
            echo "Please enter your email id <br>";
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "Enter correct email format <br>";
        }
        else{
            $email_valid = true;
        }
    }

    function validateFile($file){
        global $file_valid;

        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        // $fileTmpName = $file['tmp_name'];
        // $fileType = $file['type'];
        
        $fileExtension = explode('.', $fileName);
        $fileExt = strtolower(end($fileExtension));
        
        $allowedExt = ['jpg', 'jpeg', 'png', 'svg'];

        if(in_array($fileExt, $allowedExt)){
            if($fileError === 0){
                if($fileSize < 500000){
                    $file_valid = true;
                    return $fileExt;
                }
                else{
                    echo "File size is too large <br>";
                }
            }
            else{
                echo "Error while Uploading file <br>";
            }
        }
        else{
            echo "File Extension not allowed <br>";
        }
    }
?>