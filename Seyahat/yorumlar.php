<?php
// Veritabanına bağlan
$db = new PDO('sqlite:seyahat.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Yorumları al ve ekle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //xss açığım için
    //$name = htmlspecialchars($_POST['name']); 
    $name = ($_POST['name']);
    //$comment = htmlspecialchars($_POST['comment']);
    $comment =($_POST['comment']);


   // $stmt = $db->prepare('INSERT INTO comments (name, comment) VALUES (:name, :comment)');
   // $stmt->bindParam(':name', $name, PDO::PARAM_STR);
   /// $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
   // $stmt->execute();
}

// Yorumları tekrar göster
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
