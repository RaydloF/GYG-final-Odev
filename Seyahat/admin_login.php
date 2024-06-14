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

// POST ile gelen verileri alma ve temizleme
//$username = htmlspecialchars($_POST['username']);
//$password = htmlspecialchars($_POST['password']);

//SQLİ AÇIĞIM
$username = $_POST['username'];
$password = $_POST['password'];
 

// Veritabanında admin kullanıcısını doğrulama
try {
    $stmt = $db->prepare("SELECT * FROM admin WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
//SQLİ AÇIĞIM
 // Sorguyu hazırlama
    //$query = "SELECT * FROM admin WHERE username = '" . $username . "' AND password = '" . $password . "'";
    // Sorguyu çalıştırma
   // $stmt = $db->query($query);
    // Sonucu al
   // $admin = $stmt->fetch(PDO::FETCH_ASSOC);

 
    

    if ($admin) { // Kullanıcı bulundu
        // Oturum bilgilerini sakla
        $_SESSION['admin_username'] = $admin['username'];
        
        // Admin paneline yönlendir
        header("Location: admin_panel.php");
        exit();
    } else {
        echo "<h1 style='text-align: center; margin-top: 20%; color: #dc3545;'>Kullanıcı adı veya şifre hatalı!</h1>";
    }
} catch (Exception $e) {
    echo "Giriş hatası: " . $e->getMessage();
}
?>
