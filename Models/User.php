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
    $user = new User($this->db);
    $user->setId($queryResult['id']);
    $user->setUsername($queryResult['username']);
    $user->setHashedPassword($queryResult['hashedPassword']);
    $user->setEmail($queryResult['email']);
    $user->setGroupe($queryResult['groupe']);
    $user->setStatus($queryResult['status']);
    $user->setCreationDate($queryResult['creation_date']);
    $user->setEditionDate($queryResult['edition_date']);
    return $user;
  }


  public function getUserById($id)
  {

    $res = $this->db->readOneWithId($id, 'users', ['*']);
    $user = new User($res['id'], $res['username'], $res['hashedPassword'], $res['email'], $res['groupe'], $res['status'], $res['creation_date'], $res['edition_date']);
    return $user;
  }

  public function getUserByEmail($email)
  {

    $res = $this->db->readOneWithEmail($email, 'users', ['*']);
    var_dump($res);
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
    $this->user = $this->setAttributes($res);
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

  public function setId($id)
  {
    $this->id = $id;
  }
  public function setUsername($username)
  {
    $this->username = $username;
  }
  public function setHashedPassword($hashedPassword)
  {
    $this->hashedPassword = $hashedPassword;
  }
  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function setGroupe($groupe)
  {
    $this->groupe = $groupe;
  }
  public function setStatus($status)
  {
    $this->status = $status;
  }
  public function setCreationDate($creation_date)
  {
    $this->creation_date = $creation_date;
  }
  public function setEditionDate($edition_date)
  {
    $this->edition_date = $edition_date;
  }
}


?>
