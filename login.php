<?php
require_once  ("class/DBconnection.php");
require_once ("class/user.php");
require_once("C:/xampp/htdocs/website/ProjetBDEWeb/fonctions/Alert.php");

$login = new USER();

session_start();

// Procédure pour se logger

if($login->is_loggedin()!="")
{
 
$login->redirect("home.php");
 
 
}

if(isset($_POST['btn-login']))
{
 $username = $_POST['username'];
 $password = $_POST['password'];
  
 if($login->login($username,$password))
 {
  
  $login->redirect("home.php");

 }
 else
 {
  
 alert("Wrong Details !");
 } 
}
// Procédure register

if(isset($_POST['btn-signup']))
{
   $nom = trim($_POST['nom']);
   $prenom = trim($_POST['prenom']);
   $username = trim($_POST['username']);
   $email = trim($_POST['email']);
   $password = trim($_POST['password']); 

    if($nom=="") {
      $error[] = "Provide a lastname please !"; 
   }
   else if($prenom=="") {
      $error[] = "Provide a name please!"; 
   }
   else if($username=="") {
      $error[] = "Provide username please !"; 
   }
   else if($email=="") {
      $error[] = "Provide email address please !"; 
   }
   
   else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error[] = 'Please enter a valid email address !';
   }
   else if($password=="") {
      $error[] = "Provide a password please !";
   }
   else if(strlen($password) < 6){
      $error[] = "Password must be atleast 6 characters"; 
   }
   else if(strlen($password) > 25){
      $error[] = "Password must contains a maximum of 25 characters"; 
   }
   
   else if ($password != $_POST['confirmpassword']) {
   	  $error[] = "2 passwords does not match!";
   }
   

   else
   {
      try
      {
         $stmt = $login->runQuery("SELECT username FROM utilisateur WHERE username=:username OR email=:email");
         $stmt->execute(array(':username'=>$username, ':email'=>$email));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
         if($row['username']==$username) {
            $error[] = "Sorry username already taken !";
         }
         else if($row['email']==$email) {
            $error[] = "Sorry email address already taken !";
         }
         else
         {
            if($login->register($username,$password,$nom,$prenom,$email)) 
            {
            	alert("Succesfully registered.");
                $login->redirect("home.php");
            }
         }
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  } 
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="web design responsive">
	<title>BDE CESI - Lyon</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script type="text/javascript" src="js/DynamicForm.js"></script>
</head>

<body>
	<header>
		
		<div id="branding">
			<img src="img/logo_bde.png">
		</div>
		
		<div class="container">
        <div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Log in</a>
							</div>
							
		
            
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" role="form" method="POST" style="display: block;">
									<div class="form-group">
										<input type="text" name="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password"  tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" id="cookie" name="cookie" >
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="btn-login" class="btn btn-block btn-primary" id="login-submit" tabindex="4" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>

									
									
           
           
			<?php
			// Si l'utilisateur ne répond pas aux critères pour s'enregistrer : on lui renvoie la ou les raison(s).
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; 
                 </div>
                 <?php
			}
			?>
			
		
           
								</form>
								<form id="register-form" action="" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="nom" tabindex="1" class="form-control" placeholder="Last name">
									</div>
									<div class="form-group">
										<input type="text" name="prenom" tabindex="1" class="form-control" placeholder="Name">
									</div>
									<div class="form-group">
										<input type="text" name="username" tabindex="1" class="form-control" placeholder="Username">
									</div>
									<div class="form-group">
										<input type="email" name="email" tabindex="1" class="form-control" placeholder="Email Address">
									</div>
									<div class="form-group">
										<input type="password" name="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="confirmpassword"  tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="text-center">
												<button type="submit" name="btn-signup" tabindex="4" class="btn btn-primary">Register</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</header>
	<section>
		
	</section>

	

</body>
</html>
