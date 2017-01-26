<?php
/**
 * Created by PhpStorm.
 * User: Rino
 * Date: 22.01.2017
 * Time: 11:37
 */

require_once($_SESSION["mypath"] . "\\controller\\posthandler.php");
?>
<header>
    <h1>NOBOX</h1>
    <nav class="mainnav"></nav>
    <?php if (isset($_SESSION["id"]))
    {
        require_once($_SESSION["mypath"] . "\\view\\includes\\logoutform.php");
    }
    else
    {
        require_once($_SESSION["mypath"] . "\\view\\includes\\loginform.php");
        require_once($_SESSION["mypath"] . "\\view\\includes\\createuserform.php");
    } ?>
    </nav>
</header>

