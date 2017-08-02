<?php

class Database
{
  private $pdo = null;
  public static $dbInstance;
  private $user = 'root';
  private $host = 'localhost';
  private $pass = 'root';
  private $dbName = 'todo_php';

  private function __construct()
  {
    $this->pdo = new PDO ('mysql:dbname='.$this->dbName.';host='.$this->host,$this->user ,$this->pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
  }

  public static function getInstance()
  {
    if(is_null(self::$dbInstance))
    {
      self::$dbInstance = new Database();
    }
    return self::$dbInstance;
  }

  public function getConnection()
  {
    return $this->pdo;
  }


}
?>
