<?php
try {
    $db = new PDO('sqlite:Seyahat.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Formdan gelen verileri al
    $id = $_POST['id'];
    $nereden = $_POST['nereden'];
    $nereye = $_POST['nereye'];
    $tarih = $_POST['tarih'];
    $saat = $_POST['saat'];

    // SQL sorgusunu hazırla ve çalıştır
    $stmt = $db->prepare("UPDATE seyahatlar SET nereden = :nereden, nereye = :nereye, tarih = :tarih, saat = :saat WHERE id = :id");
    $stmt->bindParam(':nereden', $nereden);
    $stmt->bindParam(':nereye', $nereye);
    $stmt->bindParam(':tarih', $tarih);
    $stmt->bindParam(':saat', $saat);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Seyahat bilgileri başarıyla güncellendi.";
    } else {
        echo "Güncelleme sırasında bir hata oluştu.";
    }

    exit();

} catch (Exception $e) {
    echo "Veritabanı hatası: " . $e->getMessage();
}
?>
