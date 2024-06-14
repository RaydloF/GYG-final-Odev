<?php
// Veritabanı bağlantısı oluşturma
try {
    $db = new PDO('sqlite:Seyahat.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Seyahati sil
    $seyahat_id = $_GET['id'];
    $stmt = $db->prepare("DELETE FROM seyahatlar WHERE id = :id");
    $stmt->bindParam(':id', $seyahat_id);
    $stmt->execute();

    // Seyahat başarıyla silindi mesajını göster ve ana sayfaya yönlendir
    echo "<script>alert('Seyahat başarıyla silindi.'); window.location='admin_panel.php';</script>";
} catch (Exception $e) {
    echo "Veritabanı hatası: " . $e->getMessage();
}
?>
