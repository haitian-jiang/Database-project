<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件

    $sql = "SELECT * FROM MOST_FAVOURITE_KEYOWRDS";
    $res = $conn->query($sql);
    $row = $res->fetch_all(MYSQLI_ASSOC);
    echo json_encode($row); //keyword(关键词)
?>