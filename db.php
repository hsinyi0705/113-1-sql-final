<?php
    $servername = "localhost";
    $username = "root";
    $password = "o70500hy";
    // $password = "";
    $dbname = "classicmodels";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("MySQL 伺服器連結失敗: " . mysqli_connect_error());
    }

    // mysqli_close($conn);
?>
