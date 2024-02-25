<?php
// Define variables and initialize them to empty values
$first_name = $last_name = $phone_number = $address = $pincode = $email = "";
$first_name_err = $last_name_err = $phone_number_err = $pincode_err = $email_err = "";

// Function to validate if a string contains only alphabetic characters
function isValidAlpha($str) {
    return preg_match('/^[a-zA-Z]+$/', $str);
}

// Function to validate if a string contains only numbers
function isValidNumber($str) {
    return preg_match('/^[0-9]+$/', $str);
}

// Function to validate email format
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function convertNumberToWords($num) {
    $ones = array(
        1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five',
        6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten',
        11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen',
        15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen'
    );
    $tens = array(
        20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty', 50 => 'Fifty',
        60 => 'Sixty', 70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
    );
 
    if ($num < 20) {
        return $ones[$num];
    } elseif ($num < 100) {
        return $tens[$num - ($num % 10)] . ' ' . $ones[$num % 10];
    } elseif ($num < 1000) {
        return $ones[($num / 100)] . ' Hundred ' . convertNumberToWords($num % 100);
    } elseif ($num < 100000) {
        return convertNumberToWords($num / 1000) . ' Thousand ' . convertNumberToWords($num % 1000);
    } elseif ($num < 10000000) {
        return convertNumberToWords($num / 100000) . ' Lakh ' . convertNumberToWords($num % 100000);
    } else {
        return 'Number is too large to convert';
    }
}




// Validate form fields when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate first name
    if (empty($_POST["first_name"])) {
        $first_name_err = "First name is required";
    } else {
        $first_name = $_POST["first_name"];
        if (!isValidAlpha($first_name)) {
            $first_name_err = "Only alphabetic characters are allowed in First name";
        }
    }

    // Validate last name
    if (empty($_POST["last_name"])) {
        $last_name_err = "Last name is required";
    } else {
        $last_name = $_POST["last_name"];
        if (!isValidAlpha($last_name)) {
            $last_name_err = "Only alphabetic characters are allowed in Last name ";
        }
    }


    // Validate phone number
    if (empty($_POST["phone_number"])) {
        $phone_number_err = "Phone number is required";
    } else {
        $phone_number = $_POST["phone_number"];
        if (!isValidNumber($phone_number)) {
            $phone_number_err = "Only numbers are allowed in phone number";
        } elseif (strlen($phone_number) !== 10) {
            $phone_number_err = "Phone number must be 10 digits";
        }
    }

    // Validate pincode
    if (empty($_POST["pincode"])) {
        $pincode_err = "Pincode is required";
    } else {
        $pincode = $_POST["pincode"];
        if (!isValidNumber($pincode)) {
            $pincode_err = "Only numbers are allowed in pincode";
        } elseif (strlen($pincode) !== 6) {
            $pincode_err = "Pincode must be 6 digits";
        }
    }


     // Validate email
     if (empty($_POST["email"])) {
        $email_err = "Email is required";
    } else {
        $email = $_POST["email"];
        if (!isValidEmail($email)) {
            $email_err = "Invalid email format";
        }
    }


    // Validate other fields
    $address = $_POST["address"];

    // If all fields are valid, proceed further
    if (empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($phone_number_err) && empty($pincode_err)) {
        // Process the form data
        // For demonstration, you can display the submitted data
        echo "<h2>Submitted Data</h2>";
        echo "First Name: " . $first_name . "<br>";
        echo "Last Name: " . $last_name . "<br>";
        echo "Phone Number: " . $phone_number . "<br>";
        echo "Email: " . $email . "<br>";
        echo "Address: " . $address . "<br>";
        echo "Pincode: " . $pincode . "<br>";

        echo convertNumberToWords($pincode); 
    }
    else {
        echo "{$first_name_err}<br>";
        echo "{$last_name_err} <br>";
        echo "{$email_err} <br>";
        echo "{$phone_number_err} <br>";
        echo "{$pincode_err} <br>";
    }
}
?>
