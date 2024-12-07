<?php
    require 'db.php';

    // 預設為顯示所有資料
    $sql = "SELECT id, userName, role FROM users";
    $conditions = [];

    // 執行 SQL 查詢
    $result = mysqli_query($conn, $sql);
?>


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
                <input type="text" name="user_Name" required><br>
                
                <label for="input_search">角色：</label><br>
                <select name="role">
                    <!-- <option value="">None</option> -->
                    <option value="Role_manager">管理者</option>
                    <option value="Role_user">使用者</option>
                </select><br>
                
                <label for="input_search">密碼：</label><br>
                <input type="text" name="user_Password" required><br>

                <label for="input_search">確認密碼：</label><br>
                <input type="text" name="confirm_Password" required><br>
                
                <button type="submit">新增</button>
            </form>   

            <div class="hint-message">
                <?php if (isset($hint)): ?>
                    <p><?= htmlspecialchars($hint) ?></p>
                <?php endif; ?>
            </div>


            <p class="w3">使用者列表</p>

            <table class="user-list">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>名稱</th>
                        <th>角色</th>
                        <th colspan="2">操作</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>  <!-- KEY -->
                            <td><?= htmlspecialchars($row['userName']) ?></td>
                            <td><?= htmlspecialchars($row['role']) ?></td>
                            <td colspan="2"><button type="submit">刪除</button></td>
                        </tr>
                    <?php endwhile; ?>                  
                </tbody>
            </table>
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>