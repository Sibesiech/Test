<?php
/**
 * Created by PhpStorm.
 * User: Rino
 * Date: 20.01.2017
 * Time: 18:36
 */

session_start();

$mypath = realpath("");
$_SESSION["mypath"] = $mypath;

if (!isset($_SESSION["started"]))
{
    $_SESSION["started"] = date ("d m H i s");
}

$url = explode("/", trim($_SERVER["REQUEST_URI"], "/"));

if ($url[0] != "")
{
    switch ($url[0])
    {
        case "index":
        {
            header("Location: /view/home.php");
            break;
        }
        case "home":
        {
            header("Location: /view/home.php");
            break;
        }
        default:
        {
            header("Location: /view/home.php");
            break;
        }
    }
}
else
{
    header("Location: /view/home.php");
}

exit();