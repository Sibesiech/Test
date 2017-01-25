<?php
/**
 * Created by PhpStorm.
 * User: vanonir
 * Date: 25.01.2017
 * Time: 18:14
 */

?>
    <form action="" method="post">
        <p>
            <?php
            if (isset($_SESSION["username"]))
            {
                echo "Willkommen " . $_SESSION["username"];
            }
            elseif (isset($errorlogin))
            {
                echo $errorlogin;
            }
            else
            {
                echo "Login!";
            }
            ?>

        </p><br>
        <input type="hidden" name="login" value="true">
        <input type="text" name="username" placeholder="Benutzername">
        <input type="password" name="pwd" placeholder="Passwort">
        <input type="submit" value="Login">
    </form>
    <p><?php
