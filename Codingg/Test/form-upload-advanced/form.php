<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
</head>
<body>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
        <label for="name">Enter Name:</label>
        <input type="text" id="name" name="name"><br>

        <label for="phone">Enter Phone:</label>
        <input type="text" id="phone" name="phone"><br>
        
        <label for="email">Enter Email id:</label>
        <input type="text" id="email" name="email"><br>

        <label for="upload_file">Upload File:</label>
        <input type="file" name="file" id="upload_file"><br> 

        <button type="submit" name="submit">Submit Form</button> 
    </form>

    <?php 
        include "process.php";
    ?>
</body>
</html>


<!-- 
display error messgaes as span tag next to the input element itself instead of below. 
to achieve this in validation.php, instead of echoing all erros store them in err variables and return them to 
process.php.
then echo in span tags in html
in form.php move include process.php above the form so that echo in span tags know what to display (doubt if it matters) 
-->
