<?php
/**
 * Created by PhpStorm.
 * User: vanonir
 * Date: 25.01.2017
 * Time: 18:15
 */
?>

<form action="" method="post">
    <p><?php echo "Willkommen " . $_SESSION["username"]; if ($_SESSION["username"]=="Rino") echo ", du bisch dr best!"?></p>
    <input type="hidden" name="form" value="logout">
    <button type="submit">Logout</button>
</form>
