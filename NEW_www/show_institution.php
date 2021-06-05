<?php
	header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件

    $pid = $_POST['paper_id'];     //接收前台post值
    $authorname = $_POST['author_name'];
    $authorinfosql = "SELECT institution FROM author WHERE pid = '$pid' and name = '$authorname'";
    $authorinfores = $conn->query($authorinfosql);
    $authorinforow = $authorinfores->fetch_all(MYSQLI_ASSOC);
    echo json_encode($authorinforow);
?>