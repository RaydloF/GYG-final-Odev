<?php
session_start();

if (!isset($_SESSION['username'])) {
    // Giriş yapılmamışsa giriş sayfasına yönlendir
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Arayüzü</title>
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
        .search-container {
            text-align: center;
            margin: 20px;
        }
        .search-box {
            width: 80%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Baskil Turizm'e Hoş Geldiniz, <?php echo htmlspecialchars($_SESSION['first_name']); ?>!</h1>
    </div>
    <div class="welcome-container">
        <h2>Seyahatler</h2>
        <div class="search-container">
            <form method="GET" action="">
                <input type="text" name="search" id="search" class="search-box" placeholder="Seyahat ara..." value="<?php if (isset($_GET['search'])) echo htmlspecialchars($_GET['search']); ?>">
                <input type="submit" value="Ara" class="add-travel-button">
            </form>
        </div>
        <div id="travel-list">
        <?php
        try {
            $db = new PDO('sqlite:Seyahat.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $search = '';
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
            }

            $stmt = $db->prepare("SELECT * FROM seyahatlar WHERE nereden LIKE :search OR nereye LIKE :search");
            $stmt->execute([':search' => "%$search%"]);
            $seyahatler = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            
           //echo "<div>Arama Sonuçları: " . $search . "</div>"; //- Kullanıcı girdisini doğrudan HTML içinde kullanarak XSS açığını gösteriyoruz
            
            foreach ($seyahatler as $seyahat) {
                //echo "<button class='travel-button' onclick='window.location=\"kullanıcı_seyahat_details.php?id={$seyahat['id']}\"'>{$seyahat['nereden']} - {$seyahat['nereye']}</button>";
                echo "<button class='travel-button' onclick='window.location=\"kullanıcı_seyahat_details.php?id={$seyahat['id']}\"'>" . htmlspecialchars($seyahat['nereden'], ENT_QUOTES, 'UTF-8') . " - " . htmlspecialchars($seyahat['nereye'], ENT_QUOTES, 'UTF-8') . "</button>";
            }
        } catch (Exception $e) {
           //echo "Veritabanı hatası: " . $e->getMessage();
            echo "Veritabanı hatası: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
        }
        ?>
        </div>
    </div>
</body>
</html>
