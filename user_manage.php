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
            <h1>使用者管理模組</h1>
            <div class="left">
                <button onclick="window.location.href='success_login_page.php';">返回主頁</button>
            </div>
        </header>

        <div class="manage-page">
            <form method="post" action="">
                <p class="w1">新增使用者</p>
                            
                <label for="input_search">使用者名稱：</label><br>
                <input type="text" name="user_Name"><br>
                
                
                <label for="input_search">角色：</label><br>
                <select name="role">
                    <!-- <option value="">None</option> -->
                    <option value="Role_manager">管理者</option>
                    <option value="Role_user">使用者</option>
                </select><br>
                
                <label for="input_search">密碼：</label><br>
                <input type="text" name="user_Password"><br>
                
                <button>新增</button>

                <p class="w3">使用者列表</p>
            </form>   
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>