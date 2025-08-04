<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#">Login Regist OOP</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../">Home</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <?php
                if (isset($_SESSION['userid'])) {
                ?>
                    <li class="nav-item"><a href="../signin/signout.php" class="btn btn-outline-danger ">Sign out</a></li>
                <?php  } else { ?>
                    <li class="nav-item"><a href="../signin/signin.php" class="btn btn-outline-primary ">Sign In</a></li>
                    <li class="nav-item"><a href="../signin/signup.php" class="btn btn-outline-success">Sign UP</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>