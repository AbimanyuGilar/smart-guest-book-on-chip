<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('db_connection.php');

$sql = "SELECT * FROM guest";
$result = $conn->query($sql);

// Menyiapkan header untuk file CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="data.csv"');

    // Membuka file output untuk menulis CSV
    $output = fopen('php://output', 'w');

    // Menulis header kolom (nama kolom tabel)
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        fputcsv($output, array_keys($row)); // Menulis header kolom

        // Menulis data
        $result->data_seek(0); // Reset pointer hasil query
        while ($row = $result->fetch_assoc()) {
            fputcsv($output, $row); // Menulis data
        }
    }

    fclose($output);
    exit;
?>