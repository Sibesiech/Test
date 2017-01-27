<?php

/**
 * Created by PhpStorm.
 * User: vanonir
 * Date: 25.01.2017
 * Time: 11:00
 */
class db
{
//    private $servername = "127.0.0.1";
//    private $username = "root";
//    private $password = "";
//    private $datbasename = "nobox";
    private static $connectionvars = array("servername" => "127.0.0.1",
        "username" => "root",
        "password" => "",
        "databasename" => "nobox");


//    public function __construct($servername, $username, $password, $databasename)
//    {
//        $this->servername = $servername;
//        $this->username = $username;
//        $this->password = $password;
//        $this->datbasename = $databasename;
//        $this->conn = new mysqli("$this->servername", "$this->username", "$this->password", "$this->datbasename");
//        $this->message = $this->conn->error;
//    }
    public static function configconn($servername = null, $username = null, $password = null, $databasename = null)
    {
        if (isset($servername))
        {
            self::$connectionvars["servername"] = $servername;
        }
        if (isset($username))
        {
            self::$connectionvars["username"] = $username;
        }
        if (isset($password))
        {
            self::$connectionvars["password"] = $password;
        }
        if (isset($databasename))
        {
            self::$connectionvars["databasename"] = $databasename;
        }
    }

    private static function connect()
    {
        $conn = new mysqli(self::$connectionvars["servername"], self::$connectionvars["username"], self::$connectionvars["password"], self::$connectionvars["databasename"]);
        return $conn;
    }

    public static function createuser($data)
    {
        $conn = self::connect();
        $userinsert = $conn->prepare("INSERT INTO Users (Username,Emailaddress,Hash) VALUES (?,?,?)");
        $password = hash("sha256", $data["pwd"]);
        $userinsert->bind_param("sss", $data["username"], $data["email"], $password);
        $userinsert->execute();
        $returnarray["dbmessage"] = $userinsert->error;
        if ($returnarray["dbmessage"] !== "")
        {
            $returnarray["username"] = $data["username"];
            $returnarray["id"] = $userinsert->insert_id;
        }
                $userinsert->close();

        return $returnarray;
    }


    public static function login($data)
    {
        $conn = self::connect();
        $userlogin = $conn->prepare("SELECT ID_User,Username FROM Users WHERE Username=? AND Hash=?");
        $password = hash("sha256", $data["pwd"]);
        $userlogin->bind_param("ss", $data["username"], $password);
        $userlogin->execute();
        $userlogin->bind_result($id_user, $username);
        $returnarray["loginsuccess"] = false;
        while ($userlogin->fetch())
        {
            $returnarray["id"] = htmlspecialchars($id_user);
            $returnarray["username"] = htmlspecialchars($username);
            $returnarray["loginsuccess"] = true;
        }
        $returnarray["dbmessage"] = $userlogin->error;
        $userlogin->close();
        return $returnarray;
    }


    public static function select($table, $userid = null)
    {
        $conn = self::connect();
        $returnarray["dbmessage"] = $conn->error;
        if (empty($userid))
        {
            $result = $conn->query("SELECT * FROM $table");
        }
        elseif (isset($userid))
        {
            $result = $conn->query("SELECT * FROM $table WHERE User_ID like $userid");
        }
        if ($result)
        {
            $returnarray["dbmessage"] = "successfull";
            while ($row = $result->fetch_assoc())
            {
                array_push($returnarray, $row);
            }
            $result->free();
        }
        else
        {
            $returnarray["dbmessage"] = "failed";
        }

        return $returnarray;
    }
}
