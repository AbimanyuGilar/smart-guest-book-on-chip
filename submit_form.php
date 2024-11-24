<?php
// Sertakan file koneksi
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $name = $_POST['name'];
    $agency = $_POST['agency'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = date('Y-m-d');

    try {
        // Menyiapkan query untuk memasukkan data
        $sql = "INSERT INTO guest (name, agency, email, phone, date) VALUES (:name, :agency, :email, :phone, :date)";
        $stmt = $conn->prepare($sql);

        // Mengikat parameter ke query
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':agency', $agency, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);

        // Menjalankan query
        if ($stmt->execute()) {
            header("Location: success.php");
            exit;
        } else {
            echo "Gagal menyimpan data.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null; // Menutup koneksi
?>
