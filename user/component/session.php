<?php
if (
    !isset($_SESSION['userid']) ||
    !isset($_SESSION['role']) ||
    $_SESSION['role'] !== 'user'
) {
    header("Location: ../signin/signout.php");
    exit;
}
