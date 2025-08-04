<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Signin
{
    private $conn;
    private $table_name = "users";

    public $email;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function emailNotExits()
    {
        $query = "SELECT id FROM {$this->table_name} WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyPassword()
    {
        $query = "SELECT id, password, urole FROM {$this->table_name} WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashedPassword = $row['password'];

            if (password_verify($this->password, $hashedPassword)) {

                if ($row['urole'] == "admin") {
                    $_SESSION['userid'] = $row['id'];
                    $_SESSION['role'] = $row['urole'];
                    header("Location: ../admin");
                    exit;
                } elseif ($row['urole'] == "user") {
                    $_SESSION['userid'] = $row['id'];
                    $_SESSION['role'] = $row['urole'];
                    header("Location: ../user");
                    exit;
                } else {
                    header("Location: ../index.php");
                    exit;
                }
            } else {
                return false; // Passwords do not match
            }
        }
        return false; // email not found
    }


    public function userData($userid)
    {
        $id = $userid;
        $query = "SELECT * FROM {$this->table_name} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } else {
            return false;
        }
    }

    public function signOut()
    {
        session_start();
        unset($_SESSION['userid']);
        header("Location: ../index.php");
        exit;
    }
}
