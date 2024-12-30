<?php
    require 'db.php';

    // 預設為顯示所有資料
    $sql = "SELECT id, userName, role FROM users";
    $conditions = [];

    // 執行 SQL 查詢
    $result = mysqli_query($conn, $sql);


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['register_account'];
        $password = $_POST['register_password'];
        $password_confirm = $_POST['register_password_confirm'];
        $role = $_POST['role'];

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
                $query = "INSERT INTO users (username, password, role, created_at) VALUES (?, ?, ?, NOW())";
                $stmt = $conn->prepare($query);
                
                // 密碼加密，在資料庫中顯示亂碼
                $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
                $stmt->bind_param('sss', $username, $hashed_password, $role);

                // $stmt->bind_param('ss', $username, $password);
                if ($stmt->execute()) {
                    $hint = '新增成功！';
                } 
            }
        }

        // 預設為顯示所有資料
        $sql = "SELECT id, userName, role FROM users";

        // 執行 SQL 查詢
        $result = mysqli_query($conn, $sql);
    }

    if (isset($_GET['delete_user_id'])) {
        $user_id = intval($_GET['delete_user_id']); // 轉換為整數以防注入
        $delete_query = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param('i', $user_id); // 'i' 表示整數類型參數

        if ($stmt->execute()) {
            $hint = '使用者已刪除！';
        } else {
            $hint = '刪除失敗！';
        }
    
        // 刷新資料列表
        $sql = "SELECT id, userName, role FROM users";
        $result = mysqli_query($conn, $sql);
    }
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
                <input type="text" name="register_account" required><br>
                
                <label for="input_search">角色：</label><br>
                <select name="role">
                    <!-- <option value="">None</option> -->
                    <option value="admin">管理者</option>
                    <option value="user">使用者</option>
                </select><br>
                
                <label for="input_search">密碼：</label><br>
                <input type="text" name="register_password" required><br>

                <label for="input_search">確認密碼：</label><br>
                <input type="text" name="register_password_confirm" required><br>
                
                <button type="submit">新增</button>
            </form>   

            <div class="hint-message">
                <?php if (isset($hint)): ?>
                    <p><?= htmlspecialchars($hint) ?></p>
                <?php endif; ?>
            </div>


            <p class="w3"></p>
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
                            <td colspan="2">
                                <!-- <button type="submit">編輯</button>  可修改名稱、角色、密碼 -->
                                <!-- <button type="submit">刪除</button> -->
                                <button>
                                    <a href="?delete_user_id=<?= $row['id'] ?>" 
                                    onclick="return confirm('確定要刪除這個使用者嗎？')">
                                        刪除
                                    </a>
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>                  
                </tbody>
            </table>
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>