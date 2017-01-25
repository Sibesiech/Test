<?php

/**
 * Created by PhpStorm.
 * User: vanonir
 * Date: 25.01.2017
 * Time: 11:00
 */
class db
{
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $datbasename = "nobox";
    private $port = "3306";
    private $conn;
    private $message;

    public function __construct($servername = "127.0.0.1", $username = "root", $password = "", $databasename = "nobox", $port = "3306")
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->datbasename = $databasename;
        $this->port = $port;
        $this->conn = new mysqli("$this->servername", "$this->username", "$this->password", "$this->datbasename", "$this->port");
        $this->message = $this->conn->error;
    }

    public function createuser($data)
    {
        $userinsert = $this->conn->prepare("INSERT INTO Users (Username,Emailaddress,Hash) VALUES (?,?,?)");
        $password = hash("sha256", $data["pwd"]);
        $userinsert->bind_param("sss", $data["username"], $data["email"], $password);
        $userinsert->execute();
        $_SESSION["test"] = $userinsert->get_result();
        $_SESSION["username"] = $data["username"];
        $_SESSION["id"] = $userinsert->insert_id;

        return $userinsert->error;
    }

    public function login($data)
    {
        $userlogin = $this->conn->prepare("SELECT ID_User,Username FROM Users WHERE Username=? AND Hash=?");
        $password = hash("sha256", $data["pwd"]);
        $userlogin->bind_param("ss", $data["username"], $password);
        $userlogin->execute();
        $userlogin->bind_result($id_user, $username);
        $_SESSION["loginsuccess"] =false;
        while ($userlogin->fetch())
        {
            $_SESSION["id"] = htmlspecialchars($id_user);
            $_SESSION["username"] = htmlspecialchars($username);
            $_SESSION["loginsuccess"] =true;
        }
        return $userlogin->error;
    }

    public function __destruct()
    {
        $this->conn->close();
    }

    public function __toString()
    {
        if (isset($this->message))
        {
            return $this->message;
        }
        else
        {
            return "no message set";
        }
    }

}
