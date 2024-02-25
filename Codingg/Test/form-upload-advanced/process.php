<?php
    include 'validations.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // validations of data inputed by user
        validateName($_POST['name']);
        validatePhone($_POST['phone']);
        validateEmail($_POST['email']);
        $fileExt = validateFile($_FILES['file']);


        
        if($name_valid == true && $phone_valid == true && $email_valid == true && $file_valid == true){
            
            // file uploading
            
            // $fileName = $_FILES['file']['name'];
            // $fileSize = $_FILES['file']['size'];
            // $fileError = $_FILES['file']['error'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            // $fileType = $_FILES['file']['type'];

            $current_time = time();
            $file_upload_name = date("Y-m-d h-m-sa", $current_time) . $_POST['name'] . "." . $fileExt;
            $upload_dir = "uploads/";
            if(move_uploaded_file($fileTmpName, $upload_dir . $file_upload_name)){
                echo "File has been Uploaded succesfully <br>";
            }
            else{
                echo "File was not uploaded <br>";
            }



            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];

            // new data array to be appended to json
            $data_append = [
                "Name: " => $name,
                "Phone Number: " => $phone,
                "Email Id: " => $email,
                "Uploaded File: " => $file_upload_name
            ];

            // data appending to json
            $json_file = "person_data.json";
            $file_content = file_get_contents($json_file); // getting the data inside json
            $existing_data = json_decode($file_content, true); // converting existing data in json file into array

            $existing_data[] = $data_append;
            
            $updated_json_file = json_encode($existing_data, JSON_PRETTY_PRINT); // converting new array into json
            file_put_contents($json_file, $updated_json_file); // putting new json content into json_file

            echo "Data appended succesfully <br>";
        }
        else{
            echo "Data not appended because of invalid inputs<br>";
        }
    }

?>