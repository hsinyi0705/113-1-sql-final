<?php
    require 'db.php';

    // 取得產品代碼
    $orderNumber = mysqli_real_escape_string($conn, $_GET['orderNumber']);

    $sql = "SELECT * FROM orders WHERE orderNumber = '$orderNumber'";
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
            <h1>訂單管理</h1>
            <div class="left">
                <button onclick="window.location.href='success_login_page.php';">返回主頁</button>
            </div>
        </header>
        
        <div class="manage-page">
            <p class="w1">訂單詳細資訊</p>

            <table>
                <thead>
                    <tr>
                        <th>orderNumber</th> <!-- orders -->
                        <th>productCode</th> <!-- orderdetails -> products -->
                        <th>quantityOrdered</th> <!-- orderdetails -->
                        <th>priceEach</th> <!-- orderdetails -->
                        <th>orderLineNumber</th> <!-- orderdetails -->
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr> 
                </tbody>
            </table>
            
            <button onclick="window.location.href='order_manage.php';" class="back">回到訂單清單</button>
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>