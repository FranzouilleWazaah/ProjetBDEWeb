<?php
require_once("DBconnection.php");
<<<<<<< HEAD
require_once("/../fonctions/Alert.php");
=======
require_once("C:/xampp/htdocs/website/ProjetBDEWeb/fonctions/Alert.php");
>>>>>>> origin/master

class USER
{
    private $conn;
  
  public function __construct()
  {
<<<<<<< HEAD
    $database = new Database2();
    $db2 = $database->dbConnection();
    $this->conn = $db2;
=======
    $database = new Database();
    $db = $database->dbConnection();
    $this->conn = $db;
>>>>>>> origin/master
    }
  
  public function runQuery($sql)
  {
    $stmt = $this->conn->prepare($sql);
    return $stmt;
  }
 
<<<<<<< HEAD
    public function register($nom,$prenom,$username,$email,$password,$userPic)
=======
    public function register($nom,$prenom,$username,$email,$password)
>>>>>>> origin/master
    {
       try
       {
           $new_password = password_hash($password, PASSWORD_DEFAULT);
   
<<<<<<< HEAD
           $stmt = $this->conn->prepare("INSERT INTO utilisateur(nom,prenom,username,email,password,userPic) 
                                                       VALUES(:nom,:prenom,:username,:email,:password,:userPic)");
=======
           $stmt = $this->conn->prepare("INSERT INTO utilisateur(nom,prenom,username,email,password) 
                                                       VALUES(:nom,:prenom,:username,:email,:password)");
>>>>>>> origin/master
           $stmt->bindparam(":nom", $nom);
           $stmt->bindparam(":prenom", $prenom); 
           $stmt->bindparam(":username", $username);
           $stmt->bindparam(":password", $new_password); 
<<<<<<< HEAD
           $stmt->bindparam(":email", $email);
           $stmt->bindparam(":userPic", $userPic);         
=======
           $stmt->bindparam(":email", $email);          
>>>>>>> origin/master
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 
    public function login($username,$password)
    {
       try
       {
          $stmt = $this->conn->prepare("SELECT * FROM utilisateur WHERE username=:username  LIMIT 1");
          $stmt->execute(array(':username'=>$username));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if(password_verify($password, $userRow['password']))
             {
                $_SESSION['user_session'] = $userRow['id'];
<<<<<<< HEAD
                $_SESSION['permissions'] = $userRow['permissions'];
                $_SESSION['username'] = $userRow['username'];
=======
>>>>>>> origin/master
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
 
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }
 
   public function redirect($url)
   {
       header("Location: $url");
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        alert("You have been disconnected.");
        return true;
   }
}
?>