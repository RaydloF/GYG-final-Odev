<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Detayları</title>
    <style>
        body {
            background-image: url('seyahat.jpg'); /* Halısaha fotoğrafının dosya adını buraya ekleyin */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .details-container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .details-container h1 {
            color: #007bff;
            margin-bottom: 20px;
        }
        .details-container p {
            margin-bottom: 10px;
        }
        .delete-form {
            margin-top: 20px;
        }
        .delete-form button {
            padding: 10px 20px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-form button:hover {
            background-color: #c82333;
        }
    </style>
    <script>
        let timeout;

        function resetTimeout() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                window.location.href = 'admin_panel.php'; 
            }, 10000); // 10 saniye (10,000 milisaniye)
        }

        document.addEventListener('mousemove', resetTimeout);
        document.addEventListener('keypress', resetTimeout);
        document.addEventListener('scroll', resetTimeout);
        document.addEventListener('click', resetTimeout);

        window.onload = resetTimeout;
    </script>
</head>
<body>
    <div class="details-container">
        <?php
        try {
            // Veritabanı bağlantısı oluşturma
            $db = new PDO('sqlite:Seyahat.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Kullanıcı bilgilerini getir
            $user_id = $_GET['id'];
            $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(':id', $user_id);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Kullanıcı bilgilerini göster
            echo "<h1>Kullanıcı Detayları</h1>";
            echo "<p><strong>Adı:</strong> {$user['first_name']}</p>";
            echo "<p><strong>Soyadı:</strong> {$user['last_name']}</p>";
            echo "<p><strong>Kullanıcı Adı:</strong> {$user['username']}</p>";
            echo "<p><strong>Telefon Numarası:</strong> {$user['phone']}</p>";
            echo "<p><strong>Cinsiyet:</strong> {$user['gender']}</p>";
            
            // Kullanıcıyı silme formu
            echo "<form class='delete-form' action='delete_user.php' method='post'>";
            echo "<input type='hidden' name='user_id' value='{$user['id']}'>";
            echo "<button type='submit'>Kullanıcıyı Sil</button>";
            echo "</form>";
        } catch (Exception $e) {
            echo "Veritabanı hatası: " . $e->getMessage();
        }
        ?>
         <a href="admin_panel.php">Çıkış Yap</a>
    </div>
</body>
</html>
