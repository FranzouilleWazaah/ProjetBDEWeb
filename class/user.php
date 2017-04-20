<?php
require_once("DBconnection.php");
require_once("/../fonctions/Alert.php");

class USER
{
    private $conn;
  
  public function __construct()
  {
    $database = new Database2();
    $db2 = $database->dbConnection();
    $this->conn = $db2;
    }
  
  public function runQuery($sql)
  {
    $stmt = $this->conn->prepare($sql);
    return $stmt;
  }
 
    public function register($nom,$prenom,$username,$email,$password,$userPic)
    {
       try
       {
           $new_password = password_hash($password, PASSWORD_DEFAULT);
   
           $stmt = $this->conn->prepare("INSERT INTO utilisateur(nom,prenom,username,email,password,userPic) 
                                                       VALUES(:nom,:prenom,:username,:email,:password,:userPic)");
           $stmt->bindparam(":nom", $nom);
           $stmt->bindparam(":prenom", $prenom); 
           $stmt->bindparam(":username", $username);
           $stmt->bindparam(":password", $new_password); 
           $stmt->bindparam(":email", $email);
           $stmt->bindparam(":userPic", $userPic);         
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
                $_SESSION['permissions'] = $userRow['permissions'];
                $_SESSION['username'] = $userRow['username'];
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