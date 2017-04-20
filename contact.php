<?php
require_once ("class/user.php");
require_once("session.php");
    
    $auth_user = new USER();
    
    
    $id = $_SESSION['user_session'];
    
    $stmt = $auth_user->runQuery("SELECT * FROM utilisateur WHERE id=:id");
    $stmt->execute(array(":id"=>$id));
    
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
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
</head>

<body>
    <header>
        
        <div id="branding">
            <img src="img/logo_bde.png" width="250px" height="250px">
        </div>
        <?php 
        include 'avatar.php';
            ?>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="gallery/gallery.php">Photos</a></li>
                <li><a href="boutique.php">Shop</a></li>
                <li class="current"><a href="contact.php">Contact us</a></li>
                <?php // Displays the tab if the user has the correct permission

                if ($_SESSION['permissions']=='cesiMember')
                {
                    echo '<li><a href="gallery/admin/index.php">Manage photos</a></li>';
                }

                ?>

                <?php // Displays the tab if the user has the correct permission

                if ($_SESSION['permissions']=='bdeMember')
                {
                    echo '<li><a href="index-admin.php">Administration</a></li>';
                }

                ?>

            </ul>
        </nav>
        </div>
    </header>
    <section>
        
        
    </section>
    <div class="container">
    <h3>Send us your ideas :</h3>
<form method="post" name="contact_form" id="contact_form" action="fonctions/Sendmailcontact.php">
    <div>
        <label for="nom">Name :</label>
        <input type="text" id="nom" name="name" />
    </div>
    <div>
        <label for="courriel">Email :</label>
        <input type="email" id="courriel" name="email" />
    </div>
    <div>
        <label for="message">Message :</label>
        <textarea id="message" name="message"></textarea>
    </div>
    <div class="text-center">
    <div class="button">
        <button type="submit" value="Submit">Send your message</button>
    </div>
    </div>
</form>
</div>
<script language="JavaScript">
var frmvalidator  = new Validator("contactform");
frmvalidator.addValidation("name","req","Merci de mettre votre nom.");
frmvalidator.addValidation("email","req","Merci de mettre votre adresse email.");
frmvalidator.addValidation("email","email",
  "Merci d'entrer une adresse email correcte.");
</script>
<footer>
        <div class="container">
            <p>BDE CESI - Lyon, Copyright &copy; 2017</p>
        </div>
        
    </footer>

</body>
</html>
