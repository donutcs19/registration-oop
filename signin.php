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
        <h2 class="mt-3">Register</h2>
        <hr>
        <form action="check_signin.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" aria-describedby="password">
            </div>

            <button type="submit" class="btn btn-primary">signin</button>
        </form>
        <hr>
        <p>You don't have an account? Please <a href="./signup.php">Sign up</a></p>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>