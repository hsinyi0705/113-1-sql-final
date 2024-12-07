<?php
    require 'db.php';

    // 預設為顯示所有資料
    $sql = "SELECT orderNumber, orderDate, requiredDate, shippedDate, status, comments, customerNumber FROM orders";
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
            <h1>訂單管理</h1>
            <div class="left">
                <button onclick="window.location.href='success_login_page.php';">返回主頁</button>
            </div>
        </header>

        <div class="manage-page">
            <p class="w1">訂單清單</p>

            <table>
                <thead>
                    <tr>
                        <th>訂單編號</th>
                        <th>訂單日期</th>
                        <th>交貨期限</th>
                        <th>交運日期</th>
                        <th>處理狀態</th>
                        <th>附註</th>
                        <th>客戶編號</th>
                        <th>詳細內容</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['orderNumber']) ?></td>  <!-- KEY -->
                            <td><?= htmlspecialchars($row['orderDate']) ?></td>
                            <td><?= htmlspecialchars($row['requiredDate']) ?></td>
                            <td><?= htmlspecialchars($row['shippedDate']) ?></td>
                            <td><?= htmlspecialchars($row['status']) ?></td>
                            <td><?= htmlspecialchars($row['comments']) ?></td>
                            <td><?= htmlspecialchars($row['customerNumber']) ?></td>
                            <td><a href="order_detail.php?orderNumber=<?= urlencode($row['orderNumber']) ?>">查看詳細</a></td>
                        </tr>
                    <?php endwhile; ?>                        
                </tbody>
            </table>
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>