<?php
    require 'db.php';

    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';
    $sort_by = $_POST['sort_by'] ?? 'Total_sales';
    $order = $_POST['order'] ?? 'max_to_min';

    $query = "SELECT c.customerName, COUNT(o.orderNumber) AS Total_orders, 
                    SUM(od.quantityOrdered * od.priceEach) AS Total_sales
            FROM customers c
            JOIN orders o ON c.customerNumber = o.customerNumber
            JOIN orderdetails od ON o.orderNumber = od.orderNumber";

    $conditions = [];
    if (!empty($start_date)) {
        $conditions[] = "o.orderDate >= '$start_date'";
    }
    if (!empty($end_date)) {
        $conditions[] = "o.orderDate <= '$end_date'";
    }
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(' AND ', $conditions);
    }

    $query .= " GROUP BY c.customerName";

    if ($sort_by === 'Total_sales') {
        $query .= " ORDER BY Total_sales";
    } else {
        $query .= " ORDER BY Total_orders";
    }
    $query .= ($order === 'max_to_min') ? " DESC" : " ASC";

    $result = mysqli_query($conn, $query);
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
            <h1>銷售報表</h1>
            <div class="left">
                <button onclick="window.location.href='success_login_page.php';">返回主頁</button>
            </div>
        </header>

        <div class="manage-page">
            <form method="post" action="">
                <p class="w1">銷售報表</p>
                            
                <label for="start_date">開始日期：</label><br>
                <input type="date" id="start_date" name="start_date" value="<?= htmlspecialchars($start_date) ?>"><br>

                <label for="end_date">結束日期：</label><br>
                <input type="date" id="end_date" name="end_date" value="<?= htmlspecialchars($end_date) ?>"><br>

                <label for="sort_by">排序依據：</label><br>
                <select name="sort_by">
                    <!-- <option value="">None</option> -->
                    <option value="Total_sales" <?= $sort_by === 'Total_sales' ? 'selected' : '' ?>>銷售總額</option>
                    <option value="Total_orders" <?= $sort_by === 'Total_orders' ? 'selected' : '' ?>>訂單數量統計</option>
                </select><br>

                <label for="order">排序方式：</label><br>
                <select name="order">
                    <!-- <option value="">None</option> -->
                    <option value="max_to_min" <?= $order === 'max_to_min' ? 'selected' : '' ?>>由高到低</option>
                    <option value="min_to_max" <?= $order === 'min_to_max' ? 'selected' : '' ?>>由低到高</option>
                </select><br>

                <button type="submit">製作</button>
            </form>   

            <p class="w3">報表結果</p>
            <table class="user-list">
                <thead>
                    <tr>
                        <th>客戶名稱</th>
                        <th>訂單數量</th>
                        <th>銷售總額</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['customerName']) ?></td>
                                <td><?= htmlspecialchars($row['Total_orders']) ?></td>
                                <td><?= htmlspecialchars(number_format($row['Total_sales'], 2)) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" style="text-align: center;">沒有符合的資料</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>
