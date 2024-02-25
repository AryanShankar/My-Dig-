<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <style>
        .error{
            color:red;
        }
    </style>
    <script>
        function reloadPage(){
            window.location.href = window.location.href;
        }

        function characterCount(inputElement, countElement){
            var countNum = document.getElementById(countElement);

            function updateCount(){
                countNum.textContent = inputElement.value.length;
            }
            
            inputElement.addEventListener('input', updateCount);
            inputElement.addEventListener('change', updateCount);
            

        }
    </script>
</head>
<body>
    <?php
        $fnameErr = $lnameErr = $emailErr = $pincodeErr = "";
        $fname = $lname = $email = $pincode = "";

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            if(empty($_POST["firstname"])){
                $fnameErr = "First Name is Required";
            } else{
                $fname = test_input($_POST["firstname"]);
                if (!preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $fname)) {
                    $fnameErr = "Only alphabets and spaces allowed in first name.<br>";
                }
            }
            
            if(empty($_POST["lastname"])){
                $lnameErr = "Last Name is Required";
            } else{
                $lname = test_input($_POST["lastname"]);
                if (!preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $lname)) {
                    $lnameErr = "Only alphabets and spaces allowed in last name.<br>";
                }
            }
            if(empty($_POST["email"])){
                $emailErr = "Email is Required";
            } else {
                $email = test_input($_POST["email"]);
                $emailRegex = '/^([a-zA-Z0-9\._]+)@([a-zA-Z0-9])+\.([a-z]{2,})$/';
                if (!preg_match($emailRegex, $email)) {
                    $emailErr = "Invalid email format";
                }
            }
            
            if(empty($_POST["pincode"])){
                $pincodeErr = "Pincode is Required";
            } else {
                $pincode = test_input($_POST["pincode"]);
                if(!preg_match("/^[0-9]{6}$/", $pincode)){
                    $pincodeErr = "Pincode must be six digits long";
                }
            }

            if(empty($fnameErr) && empty($lnameErr) && empty($emailErr) && empty($pincodeErr)){
                echo "<h2>Input Details:</h2>";
                echo "<p>First Name: $fname</p>";
                echo "<p>Last Name: $lname</p>";
                echo "<p>Email: $email</p>";
                echo "<p>Pin Code: $pincode</p>";
            }

            
        }

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function check_errors($data){
            global $fnameErr, $lnameErr, $emailErr, $pincodeErr;
            if(!empty($emailErr) || !empty($fnameErr) || !empty($lnameErr) || !empty($pincodeErr)){
                return $data;
            }
        }


    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="firstname">First Name:</label><br>
        <input type="text" name="firstname" minlegth=3 maxlength=18 oninput="characterCount(this,'fnameCount')" value="<?php echo check_errors($fname);?>" >
        <span class="error">* <?php echo $fnameErr; ?></span><br>
        <span id="fnameCount">0</span><br>

        <label for="lastname">Last Name: </label><br>
        <input type="text" name="lastname" minlength=3 maxlength=18 oninput="characterCount(this,'lnameCount')" value="<?php echo check_errors($lname) ?>">
        <span class="error">* <?php echo $lnameErr; ?></span><br>
        <span id="lnameCount">0</span><br>

        <label for="email">Email: </label><br>
        <input type="text" name="email" oninput="characterCount(this,'emailCount')" value="<?php echo check_errors($email) ?>">
        <span class="error">* <?php echo $emailErr;?></span><br>
        <span id="emailCount">0</span><br>

        <label for="pincode">Pincode: </label><br>
        <input type="text" name="pincode" minlength="6" maxlength="6" oninput="characterCount(this,'pincodeCount')" value="<?php echo check_errors($pincode) ?>">
        <span class="error">* <?php echo $pincodeErr; ?></span><br>
        <span id="pincodeCount">0</span><br><br>

        <input type="submit" value="Submit">

        <input type="button" name="reload_button" id="reload" value="Reload" onclick="reloadPage();">
    </form>
</body>
</html>