<?php
if (
    !isset($_SESSION['userid']) ||
    !isset($_SESSION['role']) ||
    $_SESSION['role'] !== 'admin'
) {
    header("Location: ../signin/signout.php");
    exit;
}
