<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ClassicModels 管理系統</title>
        <link rel="stylesheet" href="register.css">
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

        <div class="register-page">
            <form method="get" action="">
                <p class="w1">註冊</p>
                            
                <label for="input_search">帳號：</label><br>
                <input type="text" name="register_account"><br>
                
                <label for="input_search">密碼：</label><br>
                <input type="text" name="register_password"><br>

                <label for="input_search">確認密碼：</label><br>
                <input type="text" name="register_password_confirm"><br>
                
                <button>註冊</button>
            </form>    
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>