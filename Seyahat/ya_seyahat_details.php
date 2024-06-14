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
        .delete-button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
        .exit-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .exit-button:hover {
            background-color: #0056b3;
        }
        .update-button {
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .update-button:hover {
            background-color: #218838;
        }
        input[type="text"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: calc(100% - 18px);
        }
        #message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            display: none;
        }
    </style>
    <script>
        let timeout;

        function resetTimeout() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                window.location.href = 'yardımcı_admin_panel.php'; 
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
            echo "<p id='nereden-display'><strong>Nerden:</strong> {$seyahat['nereden']}</p>";
            echo "<p id='nereye-display'><strong>Nereye:</strong> {$seyahat['nereye']}</p>";
            echo "<p id='tarih-display'><strong>Tarih:</strong> {$seyahat['tarih']}</p>";
            echo "<p id='saat-display'><strong>Saat:</strong> {$seyahat['saat']}</p>";
          
            echo "<form id='updateForm'>";
            echo "<input type='hidden' name='id' value='{$seyahat_id}'>";
            echo "<label for='nereden'>Nerden:</label>";
            echo "<input type='text' id='nereden' name='nereden' value='{$seyahat['nereden']}' required><br>";
            echo "<label for='nereye'>Nereye:</label>";
            echo "<input type='text' id='nereye' name='nereye' value='{$seyahat['nereye']}' required><br>";
            echo "<label for='tarih'>Tarih:</label>";
            echo "<input type='text' id='tarih' name='tarih' value='{$seyahat['tarih']}' required><br>";
            echo "<label for='saat'>Saat:</label>";
            echo "<input type='text' id='saat' name='saat' value='{$seyahat['saat']}' required><br>";
            echo "<button class='update-button' type='submit'>Güncelle</button>";
            echo "</form>";
        } catch (Exception $e) {
            echo "Veritabanı hatası: " . $e->getMessage();
        }
        ?>
    
    <button class="exit-button" onclick="window.location.href = 'yardımcı_admin_panel.php'">Çıkış Yap</button>
    <div id="message"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#updateForm').submit(function(event){
                event.preventDefault(); // Sayfanın yeniden yüklenmesini engellemek için formun varsayılan davranışını durdurun
                var formData = $(this).serialize(); // Form verilerini alın

                // Ajax isteğini yapın
                $.ajax({
                    type: 'POST',
                    url: 'update_seyahat.php', // Verileri güncelleyecek olan PHP dosyasının yolunu belirtin
                    data: formData, // Form verilerini Ajax isteği ile gönderin
                    success: function(response){
                        // Başarılı bir şekilde güncellendiğinde kullanıcıya bildirim gösterin
                        

                        // Seyahat detaylarını güncelle
                        $('#nereden-display').html('<strong>Nerden:</strong> ' + $('#nereden').val());
                        $('#nereye-display').html('<strong>Nereye:</strong> ' + $('#nereye').val());
                        $('#tarih-display').html('<strong>Tarih:</strong> ' + $('#tarih').val());
                        $('#saat-display').html('<strong>Saat:</strong> ' + $('#saat').val());
                    },
                    error: function(xhr, status, error){
                        // Hata durumunda kullanıcıya bildirim gösterin
                        $('#message').text('Bir hata oluştu: ' + error).css({
                            'display': 'block',
                            'background-color': '#f8d7da',
                            'color': '#721c24',
                            'border-color': '#f5c6cb'
                        });
                    }
                });
            });
        });
    </script>
</body>  
</html>
