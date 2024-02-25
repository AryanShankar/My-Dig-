<?php
    include_once 'header.php';
?>



    <section class="m-5">
        <h2 class="">LOG IN PAGE</h2>
        <form class="" action="./includes/login.inc.php" method="post">
            <label for="uid">Enter Your User Id/Email</label>
            <input type="text" name="uid"><br>

            <label for="pwd">Enter Your Password</label>
            <input type="password" name="pwd"><br>

            <button class="btn btn-primary" type="submit" name="submit">Log In</button>
        </form>

        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "emptyinput"){
                    echo "<p>Fill all Fields!</p>";
                }
                if($_GET["error"] == "userdoesnotexist"){
                    echo "<p>User does not exist</p>";
                }
                if($_GET["error"] == "wrongpassword"){
                    echo "<p>Password entered is wrong</p>";
                }
            }
        ?>

    </section>
    



<?php
    include_once 'footer.php';
?>