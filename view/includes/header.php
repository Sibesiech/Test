<?php
/**
 * Created by PhpStorm.
 * User: Rino
 * Date: 22.01.2017
 * Time: 11:37
 */
require_once("\\..\\..\\model/dbc.php");
require_once("\\..\\..\\model/dbfunctions.php");
if (isset($_POST["username"]))
{
    $error = createuser($conn, $_POST["username"], $_POST["email"], $_POST["pwd"]);
}
?>
<header>
    <div class="register">
        <form action="" method="post">
            <p>
                <?php
                if (isset($error))
                {
                    if (strpos($error, "uk_user_email") !== false)
                    {
                        echo "Diese E-Mail-Adresse wird bereits verwendet";
                    }
                    elseif (strpos($error, "uk_user_username") !== false)
                    {
                        echo "Dieser Benutzername wird bereits verwendet";
                    }
                }
                else
                {
                    echo "Willkommen " . $_SESSION["username"];
                }
                ?>
            </p>
            <input type="text" name="username" placeholder="Benutzername" required>
            <input type="email" name="email" placeholder="E-Mail" required>
            <input type="password" name="pwd" placeholder="Passwort" required>
            <input type="submit">
        </form>
    </div>
</header>
