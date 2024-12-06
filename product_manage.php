<?php
    require 'db.php';

    // 預設為顯示所有資料
    $sql = "SELECT productCode, productName, productLine, buyPrice FROM products";
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
            <h1>產品管理</h1>
            <div class="left">
                <button onclick="window.location.href='success_login_page.php';">返回主頁</button>
            </div>
        </header>

        <div class="manage-page">
            <p class="w1">產品清單</p>
            
            <table>
                <thead>
                    <tr>
                        <th>產品代碼</th>
                        <th>產品名稱</th>
                        <th>產品類別</th>
                        <th>價格</th>
                        <th>詳細內容</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['productCode']) ?></td>
                            <td><?= htmlspecialchars($row['productName']) ?></td>
                            <td><?= htmlspecialchars($row['productLine']) ?></td>
                            <td><?= htmlspecialchars($row['buyPrice']) ?></td>
                            <td>查看詳細</td>
                        </tr>
                    <?php endwhile; ?>                        
                </tbody>
            </table>
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>