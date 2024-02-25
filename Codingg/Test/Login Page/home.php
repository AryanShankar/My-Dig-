<?php
    include_once 'header.php';
?>

    <?php
        if(isset($_SESSION['useruid'])){
            echo "Hey {$_SESSION['userName']} your logged in";
        }
    ?>

    <h1>This is the home page</h1>
    


<?php
    include_once 'footer.php';
?>
