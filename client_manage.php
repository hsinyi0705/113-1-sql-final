<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ClassicModels 管理系統</title>
        <link rel="stylesheet" href="manage.css">
    </head>
    
    <body>
        <header>
            <h1>客戶管理</h1>
            <div class="left">
                <button onclick="window.location.href='success_login_page.php';">返回主頁</button>
            </div>
        </header>

        <div class="manage-page">
            <form method="get" action="">
                <p class="w1">客戶瀏覽與搜尋</p>
                            
                <label for="input_search">客戶編號：</label><br>
                <input type="text" name="client_No"><br>
                
                <label for="input_search">客戶名稱：</label><br>
                <input type="text" name="client_Name"><br>

                <label for="input_search">國家：</label><br>
                <input type="text" name="client_Country"><br>
                
                <button>搜尋</button>
            </form>    
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>