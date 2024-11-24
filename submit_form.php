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

    // Menyiapkan dan menjalankan query untuk memasukkan data
    $sql = "INSERT INTO guest (name, agency, email, phone, date) VALUES ('$name', '$agency', '$email', '$phone', '$date')";

    if ($conn->query($sql) === TRUE) {
      header("Location: success.php?");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
