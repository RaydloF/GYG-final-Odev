<?php
// Veritabanı bağlantısı oluşturma
try {
    $db = new PDO('sqlite:Seyahat.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Formdan gelen verileri al
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    // Kullanıcıyı güncelle
    $stmt = $db->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, username = :username, phone = :phone, gender = :gender WHERE id = :id");
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();

    // Başarı mesajını göster ve kullanıcı detayları sayfasına yönlendir
    echo "<script>alert('Kullanıcı bilgileri başarıyla güncellendi.'); window.location='ya_user_details.php?id=$user_id';</script>";
} catch (Exception $e) {
    echo "Veritabanı hatası: " . $e->getMessage();
}
?>
