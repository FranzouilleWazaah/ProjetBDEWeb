<?php session_start(); ?>
 
 
 
        <?php
if(isset($_FILES['monfichier']) AND $_FILES['monfichier']['error']==0)
    {
        if($_FILES['monfichier']['size']<=100000000)
        {         
        $infofichier=pathinfo($_FILES['monfichier']['name']);
        $extension_upload=$infofichier['extension'];
        $extensions_autorisees= array('jpg','jpeg','gif','png');
            if (in_array($extension_upload, $extensions_autorisees))
            {
            move_uploaded_file($_FILES['monfichier']['tmp_name'], 'uploads/'.basename($_FILES['monfichier']['name']));
            echo "bien envoyé";
             
            }
        }
    }
     
    ?>