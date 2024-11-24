<?php

// Cek apakah pengguna sudah login sebagai admin (misalnya dengan mengecek variabel session)
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Admin Dashboard</h1>
        <div class="list-group">
            <a href="feedbacks_view.php" class="list-group-item list-group-item-action">
                Lihat Feedback
            </a>
            <a href="guests.php" class="list-group-item list-group-item-action">
                Lihat Daftar Tamu
            </a>
        </div>
        <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
