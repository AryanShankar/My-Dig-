<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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

<h2 class="text-center mt-4 mb-4">PHP FORM VALIDATION:</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="needs-validation mx-auto p-4 bg-light rounded shadow" style="max-width: 400px;" novalidate>
    <div class="mb-3">
        <label for="txt_user_name" class="form-label">Enter Your Name:</label>
        <input type="text" class="form-control" id="txt_user_name" placeholder="Enter Valid Name" name="name" value="<?php echo $data['name']; ?>" oninput="actionOnInput('txt_user_name', 'nameCount')" required>
        <div id="nameCount" class="form-text"></div>
        <div class="text-danger"><?php echo $errors["name"];?></div>
    </div>
   
    <div class="mb-3">
        <label for="email" class="form-label">Enter your Mail:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Valid Email" value="<?php echo $data['email']; ?>" oninput="actionOnInput('email', 'emailCount')" required>
        <div id="emailCount" class="form-text"></div>
        <div class="text-danger"><?php echo $errors["email"];?></div>
    </div>
   
    <div class="mb-3">
        <label for="pincode" class="form-label">Enter Pincode:</label>
        <input type="number" class="form-control" id="pincode" placeholder="Enter Valid Pincode" name="pincode" value="<?php echo $data['pincode']; ?>" oninput="actionOnInput('pincode', 'pincodeCount')" required>
        <div id="pincodeCount" class="form-text"></div>
        <div class="text-danger"><?php echo $errors["pincode"];?></div>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Enter Phone Number:</label>
        <input type="text" class="form-control" id="phone" placeholder="Enter Valid Phone Number" name="phone" value="<?php echo $data['phone']; ?>" oninput="actionOnInput('phone', 'phoneCount')" required>
        <div id="phoneCount" class="form-text"></div>
        <div class="text-danger"><?php echo $errors["phone"];?></div>
    </div>
   
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
