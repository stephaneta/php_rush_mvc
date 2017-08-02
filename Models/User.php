<?php
include_once '../Config/db.php';


class User{

  // private $table = lcfirst(__class__);
  private $db;
  private $id;
  private $username;
  private $hashedPassword;
  private $email;
  private $groupe;
  private $status;
  private $creation_date;
  private $edition_date;

  public function __construct(Database $db)
  {
    $this->db = $db;
  }

  protected function setAttributes($queryResult)
  {
    $user = new User();
    $user->setId($queryResult['id']);
    $user->setId($queryResult['username']);
    $user->setId($queryResult['hashedPassword']);
    $user->setId($queryResult['email']);
    $user->setId($queryResult['groupe']);
    $user->setId($queryResult['status']);
    $user->setId($queryResult['creation_date']);
    $user->setId($queryResult['edition_date']);
    return $user;
  }


  public function getUserById($id)
  {

    $res = $this->db->readOne($id, 'users', ['*']);
    $user = new User($res['id'], $res['username'], $res['hashedPassword'], $res['email'], $res['groupe'], $res['status'], $res['creation_date'], $res['edition_date']);
    return $user;
  }

  public function getUserByEmail($email)
  {

    $res = $this->db->readOne($email, 'users', ['*']);
    $user = $this->setAttributes($res);
    return $user;

  }

  public function getUsers()
  {

    $res = $this->db->readAll('users', ['*']);
    // foreach ($res as $user) {
    //   $user = new Users()
    //   var_dump($user);
    //   echo'<br>';
    // }
  }

  public function createUser($username, $hashedPassword, $email, $groupe = 'user', $status = 0)
  {
    $fields = ['username' => $username, 'hashedPassword' => $hashedPassword, 'email' => $email, 'groupe' => $groupe, 'status' => $status];
    $res = $this->db->create('users', $fields);
  }

  public function updateUser($id, $fields)
  {
    $this->db->update($id, 'users', $fields);
  }

  public function deleteUser($id)
  {

  }


  //GETTERS
  public function getId()
  {
    return $this->id;
  }
  public function getHashedPassword()
  {
    return $this->hashedPassword;
  }
  public function getEmail()
  {
    return $this->email;
  }
  public function getGroupe()
  {
    return $this->groupe;
  }
  public function getStatus()
  {
    return $this->status;
  }
  public function getCreationDate()
  {
    return $this->creation_date;
  }
  public function getEditionDate()
  {
    return $this->edition_date;
  }

  //SETTERS

  // public function setUsername()
  // {
  //   $this->username = ;
  // }
  // public function setHashedPassword()
  // {
  //   $this->creation_date = ;
  // }
  // public function setEmail()
  // {
  //   $this->creation_date = new DateTime();
  // }
  //
  // public function setGroupe()
  // {
  //   $this->creation_date = new DateTime();
  // }
  // public function setStatus()
  // {
  //   $this->creation_date = new DateTime();
  // }
  public function setCreationDate()
  {
    $this->creation_date = new DateTime();
  }
  // public function setEditionDate()
  // {
  //   $this->creation_date = new DateTime();
  // }
}


?>
