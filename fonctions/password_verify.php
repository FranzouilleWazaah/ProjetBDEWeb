<?php

     $password = "123456";
     $hashed_password = "$2y$10$BBCpJxgPa8K.iw9ZporxzuW2Lt478RPUV/JFvKRHKzJhIwGhd1tpa";
     password_verify($password, $hashed_password);
          
     /*
      if the password match it will return true.
     */ 

?>