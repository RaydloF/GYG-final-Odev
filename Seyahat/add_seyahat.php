<?php
// Veritabanı bağlantısı oluşturma
try {
    $db = new PDO('sqlite:Seyahat.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Formdan gelen verileri al
    $nereden = $_POST['nereden'];
    $nereye = $_POST['nereye'];
    $tarih = $_POST['tarih'];
    $saat = $_POST['saat'];

    // Seyahati veritabanına ekle
    $stmt = $db->prepare("INSERT INTO seyahatlar (nereden, nereye, tarih, saat) VALUES (:nereden, :nereye, :tarih, :saat)");
    $stmt->bindParam(':nereden', $nereden);
    $stmt->bindParam(':nereye', $nereye);
    $stmt->bindParam(':tarih', $tarih);
    $stmt->bindParam(':saat', $saat);
    $stmt->execute();

    // Seyahat başarıyla eklendi mesajını göster ve ana sayfaya yönlendir
    echo "<script>alert('Seyahat başarıyla eklendi.'); window.location='admin_panel.php';</script>";
} catch (Exception $e) {
    echo "Veritabanı hatası: " . $e->getMessage();
}
?>
