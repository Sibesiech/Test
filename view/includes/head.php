<?php
/**
 * Created by PhpStorm.
 * User: Rino
 * Date: 21.01.2017
 * Time: 12:35
 */
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/view/css/main.css">
    <title>
        <?php
        if (isset($_SESSION["username"]))
        {

            echo $_SESSION["username"] . "'s Nobox";
        }
        else
        {
            echo "Not logged in";
        }
        ?>
    </title>

</head>
