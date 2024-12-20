<?php
    session_start();
    session_unset(); // 清除所有 Session 資料
    session_destroy(); // 終結 Session

    header("Location: login.php"); // 重定向到登入頁面
    exit;
?>
