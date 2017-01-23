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
    <a href="#signupform">SIGN UP</a>
    <div class="signupform" id="signupform">
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
                elseif (isset($_SESSION["username"]))
                {
                    echo "Willkommen " . $_SESSION["username"];
                }?>
            </p><span><a href="#">X</a></span>
            <input type="text" name="username"
                   placeholder="Benutzername" required>
            <input type="email" name="email" placeholder="E-Mail" required>
            <input type="password" name="pwd" placeholder="Passwort" required>
            <input type="submit"">
        </form>
    </div>
    <form action="" method="post">
        <button type="submit">Logout</button>
    </form>
</header>

