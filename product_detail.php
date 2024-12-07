<?php
    require 'db.php';

    // 取得產品代碼
    $productCode = mysqli_real_escape_string($conn, $_GET['productCode']);

    $sql = "SELECT * FROM products WHERE productCode = '$productCode'";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);
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
            <p class="w1">產品詳細資訊</p>
            
            <table>
                <thead>
                    <tr>
                        <th>欄</th>
                        <th>值</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($product as $key => $value): ?>
                        <tr>
                            <td><?= htmlspecialchars($key) ?></td>
                            <td><?= htmlspecialchars($value) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <button onclick="window.location.href='product_manage.php';" class="back">回到產品清單</button>
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>