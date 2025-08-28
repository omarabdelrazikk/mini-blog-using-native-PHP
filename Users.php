<?php
require "./connection.php";
class Users
{
    protected $username;
    protected $email;
    protected $password;
    protected $isadmin = false;

    public function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
    public function validate($password2): bool
    {
        if (!isset($this->username) || !isset($this->password) || !isset($this->email)) {
            return false;
        }

        if (!($this->password === $password2) ) {
            echo "Error: Password and confirm password do not match";
            return false;
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            echo "Error: Invalid email format.";
            return false;
        }
        if (strlen($this->password) < 8) {
            echo "Error: Password must be at least 8 characters long.";
            return false;
        }
        return true;
    }


    public function save()
    {
        global $conn;
        $pass = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, isadmin) VALUES (?,? ,?,?)");
        if ($stmt == false) {
            die("Error preparing statement");
        }
        
        $stmt->bind_param("sssi", $this->username, $this->email, $pass, $this->isadmin);
        $stmt->execute();
        $stmt->close();
    }

}
final class Admins extends Users
{
    public function __construct($username, $email, $password)
    {
        parent::__construct($username, $email, $password);
        $this->isadmin = true; 
    }

}

