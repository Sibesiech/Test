<?php
/**
 * Created by PhpStorm.
 * User: Vanonir
 * Date: 26.01.2017
 * Time: 13:55
 */


?>
<aside>
    <form name="">
        <input type="hidden" name="formaside" value="createcollection">
        <input type="submit" value="Neue Collection erstellen">
    </form>

    <?php
    $db = new db($servername, $dbusername, $dbpwd, $dbname);
    $result = $db->select("Users");
        var_dump($result);
    ?>

</aside>
