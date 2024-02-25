
<?php
 
    if(isset($_POST["submit"])) {
 
        $file = $_FILES['photograph'];
        echo '<pre>';
        print_r($file);
        echo '</pre>';
 
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];
 
        $fileExtension = explode(".",$fileName);
        $fileExtLower = strtolower(end($fileExtension));
 
        echo "$fileExtLower <br>";
 
       
 
 
        $allowed = array('jpg', 'jpeg', 'png', 'pdf');
 
        if(in_array($fileExtLower, $allowed)){
            if($fileError === 0){
                if($fileSize < 5000000){
                    $fileNameNew = uniqid("").".".$fileExtLower;
 
                    $fileDestination = 'uploads/'.$fileNameNew;
 
                    move_uploaded_file($fileTmpName, $fileDestination);
 
                    echo "New File Name: {$fileNameNew}";
                   
                } else{
                    echo "File is too big.";
                }
            } else {
                echo "An Error Occured.";
            }
        } else {
            echo "File type is not supported";
        }
    }
 
?>