<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seyahat Yorumları</title>
    <style>
        body {
            background-image: url('seyahat.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            color: #333;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 800px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        label, textarea, input {
            display: block;
            margin: 10px auto;
            padding: 10px;
            width: calc(100% - 24px);
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        .comment-box {
            text-align: left;
            background: #f9f9f9;
            padding: 10px;
            margin: 10px auto;
            border-radius: 5px;
            width: calc(100% - 24px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .comment-box strong {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        .comment-box p {
            margin: 0;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Seyahat Yorumları</h1>
        <form id="commentForm" action="yorumlar.php" method="post">
            <label for="name">Adınız:</label>
            <input type="text" id="name" name="name" required>
            <label for="comment">Yorumunuz:</label>
            <textarea id="comment" name="comment" required></textarea>
            <button type="submit">Yorum Yap</button>
        </form>

        <!-- Yorumları göstereceğimiz bölüm -->
        <div id="comments">
            <h2>Yorumlar</h2>
            <ul id="commentList">
                <?php
                // Veritabanına bağlan
                $db = new PDO('sqlite:seyahat.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Yorumları al ve ekranda göster
                $stmt = $db->query('SELECT name, comment FROM comments');
                $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($comments as $comment) {
                    //xss açığım için
                    echo "<li class='comment-box'><strong>" . htmlspecialchars($comment['name']) . ":</strong> <p>" . htmlspecialchars($comment['comment']) . "</p></li>";//echo "<li class='comment-box'><strong>" .($comment['name']) . ":</strong> <p>" .($comment['comment']) . "</p></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>
