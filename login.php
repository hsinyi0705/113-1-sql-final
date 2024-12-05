<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ClassicModels 管理系統</title>
        <link rel="stylesheet" href="login.css">
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
            <form method="get" action="">
                <p class="w1">登入</p>
                            
                <label for="input_search">帳號：</label><br>
                <input type="text" name="login_account"><br>
                
                <label for="input_search">密碼：</label><br>
                <input type="text" name="login_password"><br>
                
                <button onclick="window.location.href='admin_login_page.php';">登入</button>
            </form>    
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>