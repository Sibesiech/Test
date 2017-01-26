<?php

/**
 * Created by PhpStorm.
 * User: Vanonir
 * Date: 26.01.2017
 * Time: 14:43
 */
class sessinonhandler
{
    public static function login($dbresult)
    {
        $_SESSION["id"] = $dbresult["id"];
        $_SESSION["username"] = $dbresult["username"];
        if (isset($loginstate))
        {
            $_SESSION["loginsuccess"] = $dbresult["loginsuccess"];
        }
    }

    public static function logout()
    {
        $_SESSION["id"] = null;
        $_SESSION["username"] = null;
        session_destroy();
        session_start();
        header("Location: index.php");
    }

}