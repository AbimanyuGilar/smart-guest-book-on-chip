<?php
session_start();

include('db_connection.php'); // File koneksi database dengan PDO

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'] ?? '';

    if (empty($message)) {
        $error = 'Pesan feedback tidak boleh kosong.';
    } else {
        try {
            $stmt = $conn->prepare("INSERT INTO feedback (message) VALUES (:message)");
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $success = 'Feedback Anda telah dikirim.';
            } else {
                $error = 'Terjadi kesalahan saat mengirim feedback.';
            }
        } catch (PDOException $e) {
            $error = 'Terjadi kesalahan: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berikan Feedback</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Berikan Feedback</h1>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form action="feedback.php" method="POST">
            <div class="mb-3">
                <label for="message" class="form-label">Pesan Feedback</label>
                <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Feedback</button>
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>