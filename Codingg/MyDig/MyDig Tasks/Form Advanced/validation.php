<?php

// $flag = 0;

function validateFirstName($first_name) {
    if (empty($first_name)) {
        return "First name is required";
    } elseif (!preg_match("/^[a-zA-Z'-]+$/", $first_name)) {
        return "First name must contain only letters, hyphens, and apostrophes";
    }
    return "";
}

function validateNumber($number) {
    if (empty($number)) {
        return "Number is required";
    } elseif (!preg_match("/^\d{10}$/", $number)) {
        return "Number must be exactly 10 digits";
    }
    return "";
}

function validateGender($gender) {
    if (empty($gender)) {
        return "Gender is required";
    }
    return "";
}

function validateEmail($email) {
    if (empty($email)) {
        return "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format";
    }
    return "";
}

function validateFile($file) {
    if ($file["error"] != 0) {
        return "File upload error";
    }
    return "";
}

?>
