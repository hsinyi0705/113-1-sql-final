<?php
    require 'db.php';

    // 每頁顯示20筆資料
    $per_page = 20;
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($current_page - 1) * $per_page;

    // 初始化搜尋條件
    $client_No = $_GET['client_No'] ?? '';
    $client_Name = $_GET['client_Name'] ?? '';
    $client_Country = $_GET['client_Country'] ?? '';

    // 預設為顯示所有資料
    $sql = "SELECT customerNumber, customerName, contactLastName, contactFirstName, phone, country FROM customers";
    $conditions = [];

    // 如果有搜尋條件，動態生成 SQL 查詢語句
    if (!empty($_GET['client_No'])) {
        $conditions[] = "customerNumber = '" . mysqli_real_escape_string($conn, $_GET['client_No']) . "'";
    }
    if (!empty($_GET['client_Name'])) {
        $conditions[] = "customerName LIKE '%" . mysqli_real_escape_string($conn, $_GET['client_Name']) . "%'";
    }
    if (!empty($_GET['client_Country'])) {
        $conditions[] = "country LIKE '%" . mysqli_real_escape_string($conn, $_GET['client_Country']) . "%'";
    }

    // 將條件合併到 SQL 語句
    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    // 計算總資料筆數
    $count_sql = "SELECT COUNT(*) AS total FROM customers";
    if (!empty($conditions)) {
        $count_sql .= " WHERE " . implode(" AND ", $conditions);
    }
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
            <h1>客戶管理</h1>
            <div class="left">
                <button onclick="window.location.href='success_login_page.php';">返回主頁</button>
            </div>
        </header>

        <div class="manage-page">
            <form method="get" action="">
                <p class="w1">客戶瀏覽與搜尋</p>

                <label for="client_No">客戶編號：</label><br>
                <input type="text" name="client_No" value="<?= htmlspecialchars($client_No) ?>"><br>

                <label for="client_Name">客戶名稱：</label><br>
                <input type="text" name="client_Name" value="<?= htmlspecialchars($client_Name) ?>"><br>

                <label for="client_Country">國家：</label><br>
                <input type="text" name="client_Country" value="<?= htmlspecialchars($client_Country) ?>"><br>
                
                <button type="submit">搜尋</button>
                <p class="w1"></p>
            </form>  
            
            <table>
                <thead>
                    <tr>
                        <th>客戶編號</th>
                        <th>客戶名稱</th>
                        <th>聯絡人</th>
                        <th>電話</th>
                        <th>國家</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['customerNumber']) ?></td>
                                <td><?= htmlspecialchars($row['customerName']) ?></td>
                                <td><?= htmlspecialchars($row['contactLastName'] . ' ' . $row['contactFirstName']) ?></td>
                                <td><?= htmlspecialchars($row['phone']) ?></td>
                                <td><?= htmlspecialchars($row['country']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">無符合的結果</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- 分頁按鈕 -->
            <?php if (empty($conditions)): ?>
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
            <?php endif; ?>
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>