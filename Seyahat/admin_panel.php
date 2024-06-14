<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <style>
        body {
            background-image: url('seyahat.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .welcome-container {
            max-width: 500px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .welcome-container h1 {
            color: #28a745;
            margin: 0;
            padding: 0;
        }
        .user-button {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .user-button:hover {
            background-color: #0056b3;
        }
        .travel-button {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .travel-button:hover {
            background-color: #0056b3;
        }
        .add-travel-button {
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.add-travel-button:hover {
    background-color: #218838;
}

    </style>
     <script>
        let timeout;

        function resetTimeout() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                window.location.href = 'admin_login.html'; 
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

    <div class="welcome-container">
        <h1>Baskil Turizm'e Hoş Geldiniz, Admin!</h1>
        
        <h2>Kullanıcılar </h2>
        <?php
        try {
            $db = new PDO('sqlite:Seyahat.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $db->query("SELECT * FROM users");
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($users as $user) {
                echo "<button class='user-button' onclick='window.location=\"user_details.php?id={$user['id']}\"'>{$user['first_name']} {$user['last_name']}</button>";
            }
        } catch (Exception $e) {
            echo "Veritabanı hatası: " . $e->getMessage();
        }
        ?>
        
      
    </div>
      <!-- Seyahatler -->
<div class="welcome-container">
    <h2>Seyahatler</h2>
    <?php
    try {
        $stmt = $db->query("SELECT * FROM seyahatlar");
        $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($seyahatler as $seyahat) {
            echo "<button class='travel-button' onclick='window.location=\"seyahat_details.php?id={$seyahat['id']}\"'>{$seyahat['nereden']} - {$seyahat['nereye']}</button>";
        }
    } catch (Exception $e) {
        echo "Veritabanı hatası: " . $e->getMessage();
    }
    ?>
    <!-- Seyahat Ekle Butonu -->
    <button class="add-travel-button" onclick="window.location='add_seyahat.html'">Seyahat Ekle</button>
</div>

</body>
</html>
