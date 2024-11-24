<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('db_connection.php');
$stmt = $conn->query("SELECT id, name, agency, email, phone FROM guest");
$guests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Daftar Tamu</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Tamu</h1>
        <a href="admin.php" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

        <?php if (!empty($guests)): ?>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Agency</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($guests as $guest): ?>
                        <tr>
                            <td><?= htmlspecialchars($guest['id']); ?></td>
                            <td><?= htmlspecialchars($guest['name']); ?></td>
                            <td><?= htmlspecialchars($guest['agency']); ?></td>
                            <td><?= htmlspecialchars($guest['email']); ?></td>
                            <td><?= htmlspecialchars($guest['phone']); ?></td>
                            <td><?= htmlspecialchars($guest['date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning">Belum ada tamu yang mendaftar.</div>
        <?php endif; ?>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
