<!DOCTYPE html>
<html>
<head>
    <title>Form Submission</title>
    <script>
        // Function to enable/disable submit button based on form validation
        function validateForm() {
            var firstName = document.getElementById('first_name').value;
            var lastName = document.getElementById('last_name').value;
            var phone = document.getElementById('phone_number').value;
            var address = document.getElementById('address').value;
            var pincode = document.getElementById('pincode').value;

            var submitBtn = document.getElementById('submitBtn');

            // Check if all fields are filled and meet validation requirements
            // if (firstName.trim() !== '' && lastName.trim() !== '' && phone.trim() !== '' &&
            //     address.trim() !== '' && pincode.trim() !== '' &&
            //     isValidAlpha(firstName) && isValidAlpha(lastName) &&
            //     phone.length === 10 && pincode.length === 6) {
            //     submitBtn.disabled = false;
            // } else {
            //     submitBtn.disabled = true;
            // }
        }   

        // Function to update character count
        function updateCharacterCount(inputId, countId) {
            var input = document.getElementById(inputId);
            var countElement = document.getElementById(countId);
            countElement.textContent = input.value.length;
        }
    </script>
</head>
<body>

<h2>Submit Form</h2>

<form method="post" action="process.php">
    <label for="first_name">First Name:</label><br>
    <input type="text" id="first_name" name="first_name" oninput="validateForm(); updateCharacterCount('first_name', 'firstNameCount')"><span id="firstNameCount">0</span><br>

    <label for="last_name">Last Name:</label><br>
    <input type="text" id="last_name" name="last_name" oninput="validateForm(); updateCharacterCount('last_name', 'lastNameCount')"><span id="lastNameCount">0</span><br>

    <label for="phone_number">Phone Number:</label><br>
    <input type="text" id="phone_number" name="phone_number" oninput="validateForm(); updateCharacterCount('phone_number', 'phoneCount')" maxlength="10"><span id="phoneCount">0</span><br>
    
    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email" oninput="validateForm(); updateCharacterCount('email', 'emailCount')"><span id="emailCount">0</span><br>

    <label for="address">Address:</label><br>
    <input type="text" id="address" name="address" oninput="validateForm(); updateCharacterCount('address', 'addressCount')"><span id="addressCount">0</span><br>

    <label for="pincode">Pincode:</label><br>
    <input type="text" id="pincode" name="pincode" oninput="validateForm(); updateCharacterCount('pincode', 'pincodeCount')" maxlength="6"><span id="pincodeCount">0</span><br>

    <input type="submit" id="submitBtn" value="Submit" >
</form>

</body>
</html>
