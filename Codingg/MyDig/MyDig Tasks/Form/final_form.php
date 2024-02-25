<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style> 
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: #FF0000;
            font-size: 0.9em;
        }
    </style>
    <script>
        // on live input of user, form can be validated and count of characters in text can be shown
    //     function actionOnInput(inputId, countId){
    //         // Function to enable/disable submit button based on form validation
    //         function validateForm() {
    //         var firstName = document.getElementById('first_name').value;
    //         var lastName = document.getElementById('last_name').value;
    //         var phone = document.getElementById('phone_number').value;
    //         var address = document.getElementById('address').value;
    //         var pincode = document.getElementById('pincode').value;

    //         var submitBtn = document.getElementById('submitBtn');

    //         // Check if all fields are filled and meet validation requirements
    //         // if (firstName.trim() !== '' && lastName.trim() !== '' && phone.trim() !== '' &&
    //         //     address.trim() !== '' && pincode.trim() !== '' &&
    //         //     isValidAlpha(firstName) && isValidAlpha(lastName) &&
    //         //     phone.length === 10 && pincode.length === 6) {
    //         //     submitBtn.disabled = false;
    //         // } else {
    //         //     submitBtn.disabled = true;
    //         // }
    //     }   

    //     // Function to update character count
    //     function updateCharacterCount(inputId, countId) {
    //         var input = document.getElementById(inputId);
    //         var countElement = document.getElementById(countId);
    //         countElement.textContent = input.value.length;
    //     }

    //     validateForm();
    //     updateCharacterCount(inputId, countId);
    // }
    </script>
</head>
<body>
<?php
$errors = array("name" => "", "email" => "", "pincode" => "", "phone" => "");
$data = array("name" => "", "email" => "", "pincode" => "", "phone" => "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data["name"] = test_input($_POST["name"]);
    $data["email"] = test_input($_POST["email"]);
    $data["pincode"] = test_input($_POST["pincode"]);
    $data["phone"] = test_input($_POST["phone"]);

    if (empty($data["name"])) {
        $errors["name"] = "Name is required";
    } elseif (!preg_match("/^[a-zA-Z]*$/", $data["name"])) {
        $errors["name"] = "Only letters allowed";
    }

    if (empty($data["email"])) {
        $errors["email"] = "Email is required";
    } elseif (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }

    if (empty($data["pincode"])) {
        $errors["pincode"] = "Pincode is required";
    } elseif (!is_numeric($data["pincode"]) || strlen($data["pincode"]) < 5 || strlen($data["pincode"]) > 7) {
        $errors["pincode"] = "Pincode must be between 5 and 7 digits";
    } else {
        $data["formatted_number"] = numberToWords($data["pincode"]);
    }

    if (empty($data["phone"])) {
        $errors["phone"] = "Phone number is required";
    } elseif (!is_numeric($data["phone"]) || strlen($data["phone"]) != 10) {
        $errors["phone"] = "Phone number must be exactly 10 digits";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function numberToWords($num) {
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
        return $ones[($num / 100)] . ' Hundred ' . numberToWords($num % 100);
    } elseif ($num < 100000) {
        return numberToWords($num / 1000) . ' Thousand ' . numberToWords($num % 1000);
    } elseif ($num < 10000000) {
        return numberToWords($num / 100000) . ' Lakh ' . numberToWords($num % 100000);
    } else {
        return 'Number is too large to convert';
    }
}

?>
<h2>PHP FORM VALIDATION:</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="txt_user_name">Enter Your Name:</label>
    <input type="text" id="txt_user_name" placeholder="Enter Valid Name" name="name" value="<?php echo $data['name']; ?>" oninput="actionOnInput('txt_user_name', 'nameCount')"><span id="nameCount"></span>
    <span class="error" > <?php echo $errors["name"];?></span><br><br>
   
    <label for="email">Enter your Mail:</label>
    <input type="text" id="email" name="email" placeholder="Enter Valid Email" value="<?php echo $data['email']; ?>" oninput="actionOnInput('email', 'emailCount')"><span id="emailCount"></span>
    <span class="error" > <?php echo $errors["email"];?></span><br><br>
   
    <label for="pincode">Enter Pincode:</label>
    <input type="text" id="pincode" placeholder="Enter Valid Pincode" name="pincode" value="<?php echo $data['pincode']; ?>" oninput="actionOnInput('pincode', 'pincodeCount')"><span id="pincodeCount"></span>
    <span class="error" > <?php echo $errors["pincode"];?></span><br><br>

    <label for="phone">Enter Phone Number:</label>
    <input type="text" id="phone" placeholder="Enter Valid Phone Number" name="phone" value="<?php echo $data['phone']; ?>" oninput="actionOnInput('phone', 'phoneCount')"><span id="phoneCount"></span>
    <span class="error" > <?php echo $errors["phone"];?></span><br><br>
   
    <input type="submit" name="submit" value="Submit">
</form>
 
<?php
if (empty(array_filter($errors)) && $_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h2>Your inputs:</h2>";
    if (!empty($data["name"])) {
        echo "Name: {$data['name']} (Character Count: " . strlen($data['name']) . ")<br>";
    }
    if (!empty($data["email"])) {
        echo "Email: {$data['email']} <br>";
    }
    if (!empty($data["pincode"]) && !empty($data["formatted_number"])) {
        echo "Pincode: {$data['pincode']} ({$data['formatted_number']})<br>";
    }
    if (!empty($data["phone"])) {
        echo "Phone: {$data['phone']}<br>";
    }
}
?>
</body>
</html>
