<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件

    $sql = "SELECT name,COUNT(pid) AS produce FROM author GROUP BY name ORDER BY produce DESC limit 5";
    $res = $conn->query($sql);
    $row = $res->fetch_all(MYSQLI_ASSOC);
    for($i=0; $i<5; $i++){
        $row[$i]['id'] = $i + 1;
        //echo $row[$i]['id'];
        //echo $row[$i]['name'];
        //echo '<br>';
    }
    echo json_encode($row); //返还格式：id(序号),name(作者)
?>