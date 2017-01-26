<?php
/**
 * Created by PhpStorm.
 * User: Vanonir
 * Date: 26.01.2017
 * Time: 13:05
 */

require_once($_SESSION["mypath"] . "\\model\\db.php");
require_once($_SESSION["mypath"] . "\\model\\dbconfig.php");
require_once($_SESSION["mypath"] . "\\controller\\sessionhandler.php");


if (isset($_POST["form"]))
{
    switch ($_POST["form"])
    {
        case "createuser":
        {
            $db = new db($servername, $dbusername, $dbpwd, $dbname);
            $dbresult = $db->createuser($_POST);
            sessinonhandler::login($dbresult);
            break;
        }
        case "login":
        {
            $db = new db($servername, $dbusername, $dbpwd, $dbname);
            $dbresult = $db->login($_POST);
            sessinonhandler::login($dbresult);
            break;
        }
        case "logout":
        {

            sessinonhandler::logout();
            break;
        }
        case "createcollection";
        {

        }
    }
}

?>