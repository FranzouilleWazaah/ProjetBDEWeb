<?php 
require_once ("class/user.php");
require_once("session.php");
$auth_user = new USER();
$stmt = $auth_user->runQuery('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();
//if post does not exists redirect user.
if($row['postID'] == ''){
    header('Location: ./');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['postTitle'];?></title>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">


    <meta name="description" content="web design responsive">
    <title>BDE CESI - Lyon</title>
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
            <br><br><br><br>
        <nav>
            <ul>
                <li class="current"><a href="home.php">Home</a></li>
                <li><a href="gallery/gallery.php">Photos</a></li>
                <li><a href="boutique.php">Shop</a></li>
                <li><a href="contact.php">Contact us</a></li>
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


    <div class="container" id="wrapper">
        <?php
            $stmt = $auth_user->runQuery('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
            $stmt->execute(array(':postID' => $_GET['id']));
            $row = $stmt->fetch();  
            $ici = $row['postID'];

            echo '<div>';
                echo '<h1>'.$row['postTitle'].'</h1>';
                echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
                echo '<p>'.$row['postCont'].'</p>';             
            echo '</div>';
        ?>

    
    <?php
    echo '<p><a href="participe.php?id='.$row['postID'].'">Je participe</a></p>';
    ?>
        
    </div>
</html>