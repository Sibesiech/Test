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
        elseif (isset($_SESSION["loginsuccess"]) && $_SESSION["loginsuccess"] == false)
        {
            echo "Benutzername oder Passwort falsch";
        }
        else
        {
            echo "Login!";
        }
        ?>

    </p><br>
    <input type="hidden" name="form" value="login">
    <input type="text" name="username" placeholder="Benutzername" required>
    <input type="password" name="pwd" placeholder="Passwort" required>
    <input type="submit" value="Login">
    </form><?php
