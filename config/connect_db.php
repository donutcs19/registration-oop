<?php

require_once __DIR__ . '/../vendor/autoload.php'; // ถูกต้อง

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // ชี้ไปที่โฟลเดอร์หลัก
$dotenv->load();

class Database
{
    private $HOST; 
    private $DBNAME; 
    private $USERNAME; 
    private $PASSWORD;
    private $CHARSET;
    public $conn;

    public function __construct(){
        $this->HOST = $_ENV['DB_HOST'];
        $this->DBNAME = $_ENV['DB_NAME'];
        $this->USERNAME = $_ENV['DB_USERNAME'];
        $this->PASSWORD = $_ENV['DB_PASSWORD'];
        $this->CHARSET = $_ENV['DB_CHARSET'];
    }

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host" .$this->HOST. ";dbname=" .$this->DBNAME. ";charset=" .$this->CHARSET. ";", $this->USERNAME, $this->PASSWORD);
            echo "[Success] -> Connect successfuly ";
        } catch (PDOException $error) {
            echo "[Error] -> " . $error->getMessage();
        }
        return $this->conn;
    }
}

$db = new Database();
$db->getConnection();

