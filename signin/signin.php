<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shikikie : Signin</title>
    <?php require_once("./component/link.php") ?>
</head>

<body>
    <?php require_once("./component/nav.php") ?>
    <div class="container">
        <h2 class="mt-3">Signin</h2>

        <?php
        include_once("../config/connect_db.php");
        include_once("../class/Signin.php");
        include_once("../class/Utils.php");

        $connectDB = new Database();
        $db = $connectDB->getConnection();

        $user = new Signin($db);
        $bs = new Bootstrap();


        if (isset($_POST['signin'])) {
            
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            
            if ($user->emailNotExits()){
                $bs->displayAlert("Email is not exits","danger");
                // echo '<div class="alert alert-danger" role="alert">Email is not exits</div>';
            }else{
                if ($user->verifyPassword()){
                    // echo '<div class="alert alert-success" role="alert">Password matches</div>';
                }else{
                    $bs->displayAlert("Password do not match","danger");
                    // echo '<div class="alert alert-danger" role="alert">Password do not match</div>';
                }
                
                // echo '<div class="alert alert-success" role="alert">Email is exits</div>';
            }
           
            }
        ?>
        <hr>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" aria-describedby="password">
            </div>

            <button type="submit" class="btn btn-primary" name="signin">signin</button>
        </form>
        <hr>
        <p>You don't have an account? Please <a href="./signup.php">Sign up</a></p>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>