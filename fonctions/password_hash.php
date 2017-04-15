<?php

     $password = "123456";
     $hash = password_hash($passwod, PASSWORD_DEFAULT);
     $hashed_password = "$2y$10$BBCpJxgPa8K.iw9ZporxzuW2Lt478RPUV/JFvKRHKzJhIwGhd1tpa";

     /*
     "123456" will become "$2y$10$BBCpJxgPa8K.iw9ZporxzuW2Lt478RPUV/JFvKRHKzJhIwGhd1tpa"
     */ 

?>