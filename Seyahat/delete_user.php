<?php
// Veritabanı bağlantısı oluşturma
try {
    $db = new PDO('sqlite:Seyahat.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Kullanıcıyı sil
    $user_id = $_POST['user_id'];
    $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();

    // Kullanıcı başarıyla silindi mesajını göster ve ana sayfaya yönlendir
    echo "<script>alert('Kullanıcı başarıyla silindi.'); window.location='admin_panel.php';</script>";
} catch (Exception $e) {
    echo "Veritabanı hatası: " . $e->getMessage();
}
?>
