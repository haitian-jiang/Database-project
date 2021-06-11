<?php
	header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件

    $pid = $_POST['paper_id'];     //接收前台post值
    echo $pid;
    $jtimesql = "SELECT jtime FROM paper WHERE id = '$pid'";
    $jtimeres = $conn->query($jtimesql);
    $jtimerow = $jtimeres->fetch_all(MYSQLI_ASSOC);
    $jplacesql = "SELECT jplace FROM paper WHERE id = '$pid'";
    $jplaceres = $conn->query($jplacesql);
    $jplacerow = $jplaceres->fetch_all(MYSQLI_ASSOC);
    $jtimerow[0]['jtime'] = $jtimerow;
    $jtimerow[0]['jplace'] = $jplacerow;
    echo json_encode($jtimerow);
?>