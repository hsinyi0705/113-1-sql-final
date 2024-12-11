<?php
    require 'db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['register_account'];
        $password = $_POST['register_password'];
        $password_confirm = $_POST['register_password_confirm'];

        if ($password !== $password_confirm) {
            $hint = '密碼與確認密碼不相符!!!';
        } else {
            $query = "SELECT * FROM users WHERE username = ?"; // ? 是參數佔位符，表示將來會用變數來取代它
            $stmt = $conn->prepare($query);

            $stmt->bind_param('s', $username); // 將 $username 變數綁定到 SQL 查詢中的參數（?）。 's' 表示這是一個字串類型的參數。
            $stmt->execute(); // 執行查詢語句
            $result = $stmt->get_result();

            if ($result->num_rows > 0) { // 檢查查詢結果中是否有行數（即是否有相符的帳號）
                $hint = '帳號已存在!';
            } else {
                $query = "INSERT INTO users (username, password, role, created_at) VALUES (?, ?, 'user', NOW())";
                $stmt = $conn->prepare($query);
                
                // 密碼加密 (在資料庫中顯示亂碼)
                $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
                $stmt->bind_param('ss', $username, $hashed_password);

                // $stmt->bind_param('ss', $username, $password);
                if ($stmt->execute()) {
                    $hint = '註冊成功！';
                } 
            }
        }
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ClassicModels 管理系統</title>
        <link rel="stylesheet" href="login_register.css">
    </head>
    
    <body>
        <header>
            <h1>ClassicModels 管理系統</h1>
            <div class="left">
                <button onclick="window.location.href='sql_final-main.php';">回首頁</button>
            </div>
            <div class="right">
                <button onclick="window.location.href='login.php';">登入</button>
                <button onclick="window.location.href='register.php';">註冊</button>
            </div>
        </header>

        <div class="login-page">
            <form method="post" action="">
                <p class="w1">註冊</p>
                
                <label for="input_search">帳號：</label><br>
                <input type="text" name="register_account" required><br>
                
                <label for="input_search">密碼：</label><br>
                <input type="text" name="register_password" required><br>
                
                <label for="input_search">確認密碼：</label><br>
                <input type="text" name="register_password_confirm" required><br>
                
                <button type="submit">註冊</button>
            </form>    
            
            <div class="hint-message">
                <?php if (isset($hint)): ?>
                    <p><?= htmlspecialchars($hint) ?></p>
                <?php endif; ?>
            </div>
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>