<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shikikie : Welcome</title>
    <?php
    require_once("./component/link.php")
    ?>

</head>

<body>
    <?php
    require_once("./component/nav.php");
    ?>

    <div class="container">

        <?php

        include("./component/session.php");
        include_once("../config/connect_db.php");
        include_once("../class/Signin.php");

        $connectDB = new Database();
        $db = $connectDB->getConnection();

        $user = new Signin($db);

        if (isset($_SESSION['userid'])) {
            $userid = $_SESSION['userid'];
            $userData = $user->userData($userid);
        }

        ?>

        <h1 class="display-4">Welcome User, <?php echo $userData['firstname'] ?> <?php echo $userData['lastname'] ?></h1>
        <p>Your email: <?php echo $userData['email']; ?></p>

    </div>
</body>

</html>