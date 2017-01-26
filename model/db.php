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
    private $conn;
    private $message;

    public function __construct($servername, $username, $password, $databasename)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->datbasename = $databasename;
        $this->conn = new mysqli("$this->servername", "$this->username", "$this->password", "$this->datbasename");
        $this->message = $this->conn->error;
    }

    public function createuser($data)
    {
        $userinsert = $this->conn->prepare("INSERT INTO Users (Username,Emailaddress,Hash) VALUES (?,?,?)");
        $password = hash("sha256", $data["pwd"]);
        $userinsert->bind_param("sss", $data["username"], $data["email"], $password);
        $userinsert->execute();
        $returnarray["username"] = $data["username"];
        $returnarray["id"] = $userinsert->insert_id;
        $returnarray["dbmessage"] = $userinsert->error;
        $userinsert->close();

        return $returnarray;
    }


    public function login($data)
    {
        $userlogin = $this->conn->prepare("SELECT ID_User,Username FROM Users WHERE Username=? AND Hash=?");
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


    public function select($table, $userid = null)
    {
        $returnarray= array();
        if (empty($userid))
        {
            $result = $this->conn->query("SELECT * FROM $table");
        }
        elseif (isset($userid))
        {
            $result = $this->conn->query("SELECT * FROM $table WHERE ID_User like $userid");
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
