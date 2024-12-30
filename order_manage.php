<?php
    require 'db.php';

    // 每頁顯示20筆資料
    $per_page = 20;
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($current_page - 1) * $per_page;

    // 預設為顯示所有資料
    $sql = "SELECT orderNumber, orderDate, requiredDate, shippedDate, status, comments, customerNumber FROM orders";
    $conditions = [];

    // 計算總資料筆數
    $count_sql = "SELECT COUNT(*) AS total FROM products";
    $count_result = mysqli_query($conn, $count_sql);
    $count_row = mysqli_fetch_assoc($count_result);
    $total_rows = $count_row['total'];

    // 計算總頁數
    $total_pages = ceil($total_rows / $per_page);

    // 分頁查詢
    $sql .= " LIMIT $per_page OFFSET $offset";

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

            <!-- 分頁按鈕 -->
            <div class="pagination">
                <?php if ($current_page > 1): ?>
                    <a href="?page=1">首頁</a>
                    <a href="?page=<?= $current_page - 1 ?>">上一頁</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <?php if ($i == $current_page): ?>
                        <span class="current-page"><?= $i ?></span>
                    <?php else: ?>
                        <a href="?page=<?= $i ?>"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <a href="?page=<?= $current_page + 1 ?>">下一頁</a>
                    <a href="?page=<?= $total_pages ?>">最後頁</a>
                <?php endif; ?>
            </div>
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>