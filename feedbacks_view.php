<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('db_connection.php');

// Mengambil data feedback
$stmt = $conn->query("SELECT id, message, created_at FROM feedback");
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Feedback</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Lihat Feedback</h1>
        <a href="admin.php" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

        <?php if (!empty($result)): ?>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $feedback): ?>
                        <tr>
                            <td><?= htmlspecialchars($feedback['id']); ?></td>
                            <td><?= nl2br(htmlspecialchars($feedback['message'])); ?></td>
                            <td><?= htmlspecialchars($feedback['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning">Belum ada feedback.</div>
        <?php endif; ?>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
