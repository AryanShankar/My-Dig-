<?php
include 'validation.php';

$first_name = $number = $gender = $email = $file_name = "";
$first_name_err = $number_err = $gender_err = $email_err = $file_err = "";
$form_valid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name_err = validateFirstName($_POST["first_name"] ?? '');
    $number_err = validateNumber($_POST["number"] ?? '');
    $gender_err = isset($_POST["gender"]) ? validateGender($_POST["gender"]) : "Gender is required";
    $email_err = validateEmail($_POST["email"] ?? '');
    $file_err = validateFile($_FILES["file"] ?? []);

    // Check if any validation error occurred
    if (!empty($first_name_err) || !empty($number_err) || !empty($gender_err) || !empty($email_err) || !empty($file_err)) {
        $form_valid = false;
    }

    if ($form_valid) {
        $first_name = $_POST["first_name"];
        $number = $_POST["number"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];

        $fileName = $_FILES["file"]['name'];
        $fileTmpName = $_FILES["file"]['tmp_name'];
        $fileSize = $_FILES["file"]['size'];
        $fileError = $_FILES["file"]['error'];
        $fileType = $_FILES["file"]['type'];
 
        $fileExtension = explode(".",$fileName);
        $fileExtLower = strtolower(end($fileExtension));

        // Process file upload
        if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
            $current_time = time();
            $append_file_name = date("Y-m-d h-i-sa", $current_time) . '_' . $first_name . '.' . $fileExtLower;
            // echo $append_file_name;
            $upload_dir = "uploads/";
            move_uploaded_file($_FILES["file"]["tmp_name"], $upload_dir . $append_file_name);
        }

        // Create array with form data
        $form_entry = [
            "First Name" => $first_name,
            "Number" => $number,
            "Gender" => $gender,
            "Email" => $email,
            "Uploaded File" => $append_file_name
        ];

        // Open the JSON file for reading and appending
        $json_file = "form_data.json";
        $file_content = file_get_contents($json_file);
        $existing_data = json_decode($file_content, true);

        // Append new form entry to existing data array
        $existing_data[] = $form_entry;

        // Encode the updated data back to JSON format
        $updated_data_json = json_encode($existing_data, JSON_PRETTY_PRINT);

        // Write the updated data back to the JSON file
        file_put_contents($json_file, $updated_data_json);

        echo "Form submitted successfully.";
    } else {
        echo "Form validation failed. Errors: <br>";
        echo "First Name: $first_name_err <br>";
        echo "Number: $number_err <br>";
        echo "Gender: $gender_err <br>";
        echo "Email: $email_err <br>";
        echo "File: $file_err <br>";
    }
}
?>
