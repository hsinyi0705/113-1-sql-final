<?php
    require 'db.php'; 

    session_start(); // 啟用 Session

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 接收登入表單的數據
        $username = $_POST['login_account'];
        $password = $_POST['login_password'];

        // 檢查帳號是否存在
        $query = "SELECT id, username, password, role FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // 驗證密碼
            if (password_verify($password, $user['password'])) {
                // 登入成功，設置 Session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header("Location: success_login_page.php");
                exit;
            } else {
                $hint = '密碼錯誤！';
            }
        } else {
            $hint = '帳號不存在！';
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
                <p class="w1">登入</p>
                            
                <label for="input_search">帳號：</label><br>
                <input type="text" name="login_account" require><br>
                
                <label for="input_search">密碼：</label><br>
                <input type="text" name="login_password" require><br>
                
                <button type="submit">登入</button>
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