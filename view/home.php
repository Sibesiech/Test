<?php
/**
 * Created by PhpStorm.
 * User: Rino
 * Date: 21.01.2017
 * Time: 12:55
 */
echo require_once "includes/head.php";
?>
<body>
<?php
require_once "includes/header.php";


if (isset($_SESSION["id"]))
{
    require_once "includes/maincollection.php";
}
else
{
    require_once "includes/defaultcontent.php";
}

?>
</body>
</html>