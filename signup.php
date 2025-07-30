<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration-System-PDO</title>
    <?php require_once("./config/link.php") ?>
</head>

<body>

    <?php require_once("./config/nav.php") ?>

    <div class="container">
        <h2 class="mt-3">Register Page</h2>
        <hr>

        <?php
        include_once("./config/connect_db.php");
        include_once("./class/User.php");

        $connectDB = new Database();
        $db = $connectDB->getConnection();

        $user = new User($db);


        if (isset($_POST['signup'])) {
            $user->setFname($_POST['firstname']);
            $user->setLname($_POST['lastname']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->setConfirmPassword($_POST['confirm_password']);

            if (!$user->validatePassword()) {
                echo "<div class='alert alert-danger' role='alert'>Password does not match</div>";
            }

            if (!$user->checkPasswordLength()) {
                echo '<div class="alert alert-danger" role="alert">Password must be at least 8 characters</div>';
            }

            if ($user->checkEmail()) {
                echo '<div class="alert alert-danger" role="alert">This email is already exits try another </div>';
            }

            if ($user->createUser()) {
                echo '<div class="alert alert-success" role="alert">User created successfully. <a href="signin.php">Click here</a> to sign in.</div>';
            }else{
                echo '<div class="alert alert-danger" role="alert">Failed to create a user</div>';
            }
        }

        ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="mb-3">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" class="form-control" name="firstname" aria-describedby="firstname" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" class="form-control" name="lastname" aria-describedby="lastname" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" aria-describedby="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" aria-describedby="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="signup">Submit</button>
        </form>
        <hr>
        <p>You already have an account? please <a href="./signin.php">Sign in</a></p>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>