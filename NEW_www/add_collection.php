<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件

    session_start();
    $username = $_SESSION['username'];
    //$name_encoded = base64_encode($username);//查找此姓名对应的id
    $userid = base64_encode($username);//查找此姓名对应的id
    $pid = $_POST['paper_id'];     //接收前台post值
    //$date = '20'.date('ymd',time());//获取添加的时间
    $timesql = "SELECT DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s')";
    $timeres = $conn->query($timesql);
    $time = $timeres->fetch_object();
    $insertsql = "INSERT favourite (`uid`, `pid`, `collect_time`) VALUES ('$userid', '$pid', '$time')";
    $send = $conn->query($insertsql); //向favourite表中添加这条记录
    if ($send)
        return TRUE;
    else
        return FALSE;
?>