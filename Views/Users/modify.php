<?php


   echo "<form action='modify_account.php' method='post'>";
   echo "Name:<br>";
   echo "<input type='text' name='name' value=".$name."><br>";
   echo "Email:<br>";
   echo "<input type='text' name='email' value=".$firstEmail."><br>";
   echo "Password:<br>";
   echo "<input type='password' name='password'><br>";
   echo "Password_confirmation:<br>";
   echo "<input type='password' name='password_confirmation'><br>";
   echo "<input type='submit' value='Submit'>";
   echo "</form>";
 }

 if (!empty($_POST))
 {
   $flag = true;
   if (!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["password_confirmation"]))
   {
     echo "Veuillez remplir tous les champs.\n";
     $flag = false;
   }

   if (strlen($_POST["name"]) < 3 || strlen($_POST["name"]) > 10)
   {
     echo "Invalid name"."\n";
     $flag = false;
   }

   if (!validateEMAIL($_POST['email']))
   {
     echo "Invalid email"."\n";
     $flag = false;
   }

   if (strlen($_POST["password"]) < 3 || strlen($_POST["password"]) > 10 || strlen($_POST["password_confirmation"]) < 3 || strlen($_POST["password_confirmation"]) > 10 || $_POST["password"] != $_POST["password_confirmation"])
   {
     echo "Invalid password or password confirmation"."\n";
     $flag = false;
   }
   if ($flag == true)
   {
     $newPassword = sha1($_POST['password']);
     $query = "UPDATE users SET name = :name, email = :email, password = :password WHERE email = :firstEmail";
     $pdoStatement = $pdo->prepare($query);
     $pdoStatement->bindParam(":name", $_POST["name"]);
     $pdoStatement->bindParam(":email", $_POST["email"]);
     $pdoStatement->bindParam(":password", $newPassword);
     $pdoStatement->bindParam(":firstEmail", $firstEmail);
     $pdoStatement->execute();
     $_SESSION["auth"] = $_POST["name"];
     $_SESSION['flash'] = "Modification enregistrées.";
     header("location: index.php");
   }
 }
 print_form($name, $firstEmail);


 function connect_db($host, $username, $passwd, $port, $db)
 {
   try
   {
     $dbh = new PDO("mysql:host=$host;dbname=$db;port=$port", $username, $passwd);
     return $dbh;
   }
   catch (PDOException $e)
   {
     $message =  "PDO ERROR:".$e->getMessage()."storage in".ERROR_LOG_FILE."\n";
     echo $message;
     error_log($messsage, 3, ERROR_LOG_FILE);
   }
 }

 function validateEMAIL($email)
 {
   $v = "/[a-zA-Z0-9_\-.+]*@[a-zA-Z0-9\-]*.[a-zA-Z0-9_\-.+]*/";
   return (preg_match($v, $email));
 }

 ?>

</body>
</html>
