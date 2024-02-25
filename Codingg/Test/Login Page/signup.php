<?php
    include_once 'header.php';
?>



    <section class="m-5">
        <h2>THIS IS SIGNUP PAGE</h2>
        <form action="./includes/signup.inc.php" method="post">
            <input class="m-1" type="text" name="name" placeholder="Enter Name"><br>
            <input class="m-1" type="text" name="email" placeholder="Enter Email"><br>
            <input class="m-1" type="text" name="uid" placeholder="Enter Username"><br>
            <input class="m-1" type="text" name="pwd" placeholder="Enter Password"><br>
            <input class="m-1" type="text" name="pwdrepeat" placeholder="Enter Password again "><br>

            <button class="btn btn-primary mt-1" type="submit" name="submit">Sign Up</button>
        </form>


        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "emptyinput"){
                    echo "<p>Fill all Fields!</p>";
                }
                if($_GET["error"] == "invalidemail"){
                    echo "<p>Give valid Email!</p>";
                }
                if($_GET["error"] == "invaliduid"){
                    echo "<p>Give valid User Name!</p>";
                }
                if($_GET["error"] == "passwordsdontmatch"){
                    echo "<p>Both passwords dont match!</p>";
                }
                if($_GET["error"] == "usernametaken"){
                    echo "<p>Username already taken!</p>";
                }
                if($_GET["error"] == "stmtfailed"){
                    echo "<p>Something went wrong!</p>";
                }
                if($_GET["error"] == "none"){
                    echo "<p>You have signed up succesfully!</p>";
                }
            }
        ?>

    </section>




<?php
    include_once 'footer.php';
?>