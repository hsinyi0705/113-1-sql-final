<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ClassicModels 管理系統</title>
        <link rel="stylesheet" href="sql_final-main.css">
    </head>
    
    <body>
        <header>
            <h1>ClassicModels 管理系統</h1>
        </header>

        <div class="home-page">
            <p class="w1">歡迎使用 ClassicModels 管理系統</p>
            <p class="w2">您已登入，請使用下方快速導航存取系統功能。</p>
            <div>
                <button onclick="window.location.href='client_manage.php';">客戶管理</button>
                <button onclick="window.location.href='product_manage.php';">產品管理</button>
                <button onclick="window.location.href='order_manage.php';">訂單管理</button>
                <button onclick="window.location.href='sale_manage.php';">銷售報表</button>
                <button onclick="window.location.href='sql_final-main.php';">登出</button>
            </div>
            
            <!-- 如果是管理者才顯示 -->
            <p class="w2"></p>
            <p class="w2">管理者功能</p>
            <div>
                <button onclick="window.location.href='user_manage.php';">使用者管理</button>
            </div>
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>
