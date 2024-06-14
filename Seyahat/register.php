<?php
// Veritabanı bağlantısı oluşturma
try {
    $db = new PDO('sqlite:Seyahat.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
    exit();
}

// POST ile gelen verileri alma
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$password = $_POST['password']; // Şifreyi hashlemeden saklıyoruz

// Verileri veritabanına kaydetme
try {
    $stmt = $db->prepare("INSERT INTO users (first_name, last_name, username, phone, gender, password) VALUES (:first_name, :last_name, :username, :phone, :gender, :password)");
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    
    echo "<script>alert('Kayıt Başarılı'); window.location.href = 'register.html';</script>";
} catch (Exception $e) {
    echo "Kayıt hatası: " . $e->getMessage();
}
?>
