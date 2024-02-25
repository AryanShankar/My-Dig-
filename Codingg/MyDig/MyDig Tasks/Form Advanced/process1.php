<?php
// include 'validation.php';

// $first_name = $number = $gender = $email = $file_name = "";
// $first_name_err = $number_err = $gender_err = $email_err = $file_err = "";
// $form_valid = true;

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $first_name_err = validateFirstName($_POST["first_name"] ?? '');
//     $number_err = validateNumber($_POST["number"] ?? '');
//     $gender_err = isset($_POST["gender"]) ? validateGender($_POST["gender"]) : "Gender is required";
//     $email_err = validateEmail($_POST["email"] ?? '');
//     $file_err = validateFile($_FILES["file"] ?? []);

//     // Check if any validation error occurred
//     if (!empty($first_name_err) || !empty($number_err) || !empty($gender_err) || !empty($email_err) || !empty($file_err)) {
//         $form_valid = false;
//     }

//     if ($form_valid) {
//         $first_name = $_POST["first_name"];
//         $number = $_POST["number"];
//         $gender = $_POST["gender"];
//         $email = $_POST["email"];

//         // Process file upload
//         if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
//             $file_name = time() . '_' . $_FILES["file"]["name"];
//             $upload_dir = "uploads/";
//             move_uploaded_file($_FILES["file"]["tmp_name"], $upload_dir . $file_name);
//         }

//         // Create array with form data
//         $form_entry = [
//             "First Name" => $first_name,
//             "Number" => $number,
//             "Gender" => $gender,
//             "Email" => $email,
//             "Uploaded File" => $file_name
//         ];

//         // Convert the form entry to JSON format
//         $form_entry_json = json_encode($form_entry, JSON_PRETTY_PRINT) . PHP_EOL;

//         // Open the JSON file for appending
//         $json_file = "form_data.json";
//         $file_handle = fopen($json_file, 'a+');

//         if ($file_handle) {
//             // Append the form entry JSON to the file
//             fwrite($file_handle, $form_entry_json);
//             fclose($file_handle);
//             echo "Form submitted successfully.";
//         } else {
//             echo "Failed to open JSON file.";
//         }
//     } else {
//         echo "Form validation failed. <br> Errors: <br>";
//         echo "First Name: $first_name_err <br>";
//         echo "Number: $number_err <br>";
//         echo "Gender: $gender_err <br>";
//         echo "Email: $email_err <br>";
//         echo "File: $file_err <br>";
//     }
// }
?>
