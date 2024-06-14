<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seyahat Detayları</title>
    <style>
        body {
            background-image: url('seyahat.jpg');
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
        .details-container h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        .details-container p {
            margin-bottom: 10px;
        }
    </style>
    <script>
        let timeout;

        function resetTimeout() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                window.location.href = 'dashboard.php'; 
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
            $db = new PDO('sqlite:Seyahat.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $seyahat_id = $_GET['id'];
            $stmt = $db->prepare("SELECT * FROM seyahatlar WHERE id = :id");
            $stmt->bindParam(':id', $seyahat_id);
            $stmt->execute();
            $seyahat = $stmt->fetch(PDO::FETCH_ASSOC);
            
            echo "<h2>Seyahat Detayları</h2>";
            echo "<p><strong>Nerden:</strong> {$seyahat['nereden']}</p>";
            echo "<p><strong>Nereye:</strong> {$seyahat['nereye']}</p>";
            echo "<p><strong>Tarih:</strong> {$seyahat['tarih']}</p>";
            echo "<p><strong>Saat:</strong> {$seyahat['saat']}</p>";
        } catch (Exception $e) {
            echo "Veritabanı hatası: " . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>
