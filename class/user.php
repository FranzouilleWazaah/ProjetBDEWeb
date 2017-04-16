<?php
require_once("DBconnection.php");
require_once("C:/xampp/htdocs/website/ProjetBDEWeb/fonctions/Alert.php");

class USER
{
    private $conn;
  
  public function __construct()
  {
    $database = new Database();
    $db = $database->dbConnection();
    $this->conn = $db;
    }
  
  public function runQuery($sql)
  {
    $stmt = $this->conn->prepare($sql);
    return $stmt;
  }
 
    public function register($username,$password,$nom,$prenom,$email)
    {
       try
       {
           $new_password = password_hash($password, PASSWORD_DEFAULT);
   
           $stmt = $this->conn->prepare("INSERT INTO utilisateur(username,password,nom,prenom,email) 
                                                       VALUES(:username,:password,:nom,:prenom,:email)");
              
           $stmt->bindparam(":username", $username);
           $stmt->bindparam(":password", $new_password); 
           $stmt->bindparam(":nom", $username);
           $stmt->bindparam(":prenom", $username);  
           $stmt->bindparam(":email", $email);          
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