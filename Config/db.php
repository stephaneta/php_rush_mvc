<?php

class Database
{
  private $pdo = null;
  public static $dbInstance;
  private $user = 'root';
  private $host = 'localhost';
  private $pass = 'root';
  private $dbName = 'rush_mvc';

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


  public function readOneWithId($id, $table, $fields = array())
  {
    $str = '';
    for($i=0;$i<count($fields);$i++)
    {
      $str .= $fields[$i].', ';
    }
    $str = substr($str, 0, -2);
    $query = "SELECT ".$str." FROM ".$table." WHERE id = ".$id."";
    var_dump($query);
    $pdo = $this->getConnection();
    $tmp = $pdo->prepare($query);
    $tmp->execute(array($id));
    $res = $tmp->fetch(PDO::FETCH_ASSOC);
    return $res;
  }

  public function readOneWithEmail($email, $table, $fields = array())
  {
    $str = '';
    for($i=0;$i<count($fields);$i++)
    {
      $str .= $fields[$i].', ';
    }
    $str = substr($str, 0, -2);
    $query = "SELECT $str FROM $table WHERE email = '".$email."'";
    var_dump($query);
    echo '<br>';
    $pdo = $this->getConnection();
    $tmp = $pdo->prepare($query);
    $tmp->execute(array($email));
    $res = $tmp->fetch(PDO::FETCH_ASSOC);
    return $res;
  }

  public function readOneWithTitle($title, $table, $fields = array())
  {
    $str = '';
    for($i=0;$i<count($fields);$i++)
    {
      $str .= $fields[$i].', ';
    }
    $str = substr($str, 0, -2);
    $query = "SELECT $str FROM $table WHERE title = '".$title."'";

    $pdo = $this->getConnection();
    $tmp = $pdo->prepare($query);
    $tmp->execute(array($email));
    $res = $tmp->fetch(PDO::FETCH_ASSOC);
    return $res;
  }

  public function readAll($table, $fields = array(), $limit = null, $sort = null)
 {
   $str = '';
   for($i=0;$i<count($fields);$i++)
   {
     $str .= $fields[$i].', ';
   }
   $str = substr($str, 0, -2);
   if($limit != null)
   {
     $query = "SELECT ".$str." FROM ".$table." LIMIT $limit";
   }
   else
   {
     $query = "SELECT ".$str." FROM ".$table."";
   }
   $pdo = $this->getConnection();
   $tmp = $pdo->prepare($query);
   $tmp->execute();
   $res = $tmp->fetchAll(PDO::FETCH_ASSOC);
   return $res;
 }

  public function update($id, $table, $fields = array())
  {

    $strCol = '';
    $values = [];
    foreach ($fields as $key => $value) {
      $strCol.= $key.' = ?, ';
      $values[] = $value;
    }

    $strCol = substr($strCol, 0, -2);
    echo $strCol;
    echo '<br>';

    $query = "UPDATE ".$table." SET ".$strCol." ,edition_date= NOW() WHERE id = ".$id."";
    echo '<br>';
    echo $query;
    echo '<br>';
    var_dump($values);
    $pdo = $this->getConnection();
    $tmp = $pdo->prepare($query);
    $tmp->execute($values);
  }

  public function create($table, $fields = array())
  {
    $strCol = '';
    $params = '';
    $values = [];
    foreach ($fields as $key => $value) {
      $strCol.= $key.', ';
      $params .= '?, ';
      $values[] = $value;
    }

    $strCol = substr($strCol, 0, -2);
    $params = substr($params, 0, -2);
    $query = "INSERT INTO $table($strCol, creation_date) VALUES ($params, NOW())";
    $pdo = $this->getConnection();
    $tmp = $pdo->prepare($query);
    $tmp->execute($values);
  }

  public function delete($id, $table)
  {
    $query = "DELETE FROM $table WHERE id = $id";
    var_dump($query);
    $pdo = $this->getConnection();
    $tmp = $pdo->prepare($query);
    $tmp->execute(array($id));
  }

}
?>
