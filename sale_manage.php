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
                <input type="date" id="start_date" name="start_date"><br>

                <label for="end_date">結束日期：</label><br>
                <input type="date" id="end_date" name="end_date"><br>

                <label for="input_search">排序依據：</label><br>
                <select name="sort_by">
                    <!-- <option value="">None</option> -->
                    <option value="Total_sales">銷售總額</option>
                    <option value="Total_orders">訂單數量統計</option>
                </select>
                
                <button>製作</button>

                <p class="w3">報表結果</p>
            </form>   
        </div>
        
        <footer>@ 2024 ClassicModels. All rights reserved.</footer>
    </body>
</html>