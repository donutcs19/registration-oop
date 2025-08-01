<?php
class Register
{
    private $conn;
    private $table_name = "users";

    public $fname;
    public $lname;
    public $email;
    public $password;
    public $confirm_password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function setFname($fname)
    {
        $this->fname = $fname;
    }
    public function setLname($lname)
    {
        $this->lname = $lname;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setConfirmPassword($confirm_password)
    {
        $this->confirm_password = $confirm_password;
    }
    public function validatePassword()
    {
        if ($this->password !== $this->confirm_password) {
            return false;
        }
        return true;
    }

    public function checkPasswordLength()
    {
        if (strlen($this->password) < 8) {
            return false;
        }
        return true;
    }

    public function validateUserInput()
    {
        if (!$this->validatePassword() || !$this->checkPasswordLength() || $this->checkEmail()) {
            return false;
        }
        return true;
    }


    public function createUser()
    {

        if (!$this->validateUserInput()) {
            return false;
        }

        $query = "INSERT INTO {$this->table_name}(firstname, lastname, email, password, urole, created_at, updated_at) VALUES (:fname, :lname, :email, :password, 'user', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $stmt = $this->conn->prepare($query);

        $this->fname = htmlspecialchars(strip_tags($this->fname));
        $this->lname = htmlspecialchars(strip_tags($this->lname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);


        $stmt->bindParam(":fname", $this->fname);
        $stmt->bindParam(":lname", $this->lname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $hashedPassword);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function checkEmail()
    {
        $query = "SELECT id FROM {$this->table_name} WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
