<?php
/**
 * Created by PhpStorm.
 * User: vanonir
 * Date: 25.01.2017
 * Time: 18:13
 */
?>
<form action="" method="post">
    <p>
        <?php
        if (isset($_SESSION["username"]) && empty($errorcreateuser))
        {
            echo "Willkommen " . $_SESSION["username"];
        }
        elseif (isset($errorcreateuser))
        {
            if (strpos($errorcreateuser, "uk_user_email") !== false)
            {
                echo "Diese E-Mail-Adresse wird bereits verwendet!";
            }
            elseif (strpos($errorcreateuser, "uk_user_username") !== false)
            {
                echo "Dieser Benutzername wird bereits verwendet!";
            }

        }
        else
        {
            echo "Registrieren!";
        }
        ?>
    </p>
    <input type="hidden" name="createuser" value="true">
    <input type="text" name="username" placeholder="Benutzername" required>
    <input type="email" name="email" placeholder="E-Mail" required>
    <input type="password" name="pwd" placeholder="Passwort" required>
    <input type="submit" value="Registrieren">
</form>