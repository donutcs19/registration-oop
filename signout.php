<?php

    include_once("./config/connect_db.php");
    include_once("./class/Signin.php");

    $connectDB = new Database();
    $db = $connectDB->getConnection();

    $user = new Signin($db);
    $user->signOut();


?>