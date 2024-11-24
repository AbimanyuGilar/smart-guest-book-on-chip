<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('db_connection.php');

try {
    // Query untuk mengambil semua data dari tabel guest
    $sql = "SELECT * FROM guest";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Menyiapkan header untuk file CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="data.csv"');

    // Membuka file output untuk menulis CSV
    $output = fopen('php://output', 'w');

    // Menulis header kolom (nama kolom tabel)
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        fputcsv($output, array_keys($row)); // Menulis header kolom

        // Menulis data
        $stmt->execute(); // Menjalankan ulang query untuk mengembalikan pointer
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, $row); // Menulis data
        }
    }

    fclose($output);
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>
