<?php
session_start();

// Veritabanı bağlantısı oluşturma
try {
    $db = new PDO('sqlite:Seyahat.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
    exit();
}

// POST ile gelen verileri alma
$username = $_POST['username'];
$password = $_POST['password'];

// Veritabanında kullanıcıyı doğrulama
try {
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $db = new PDO('sqlite:halisaha.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($user) {
        if ($password === $user['password']) { // Şifre doğrulama
            // Oturum bilgilerini sakla
            $_SESSION['username'] = $user['username'];
            $_SESSION['first_name'] = $user['first_name'];
            
            // Kullanıcı arayüzüne yönlendir
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<h1 style='text-align: center; margin-top: 20%; color: #dc3545;'>Şifre hatalı!</h1>";
        }
    } else {
        echo "<h1 style='text-align: center; margin-top: 20%; color: #dc3545;'>Kullanıcı adı hatalı!</h1>";
    }
} catch (Exception $e) {
    echo "Giriş hatası: " . $e->getMessage();
}
?>
