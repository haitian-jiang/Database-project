<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件

    session_start();
    //$username = $_SESSION['username'];
    //$userid = base64_encode($username);//查找此姓名对应的id
    $name_encoded = session_id(); 
    $uidsql = "SELECT * FROM user WHERE username = '$name_encoded'";
    $uidres = $conn->query($uidsql);
    $uidrow = $uidres->fetch_object();
    $uid = $uidrow->id;

    $sql = "SELECT * FROM favourite WHERE uid = '$uid'";
    $res = $conn->query($sql);
    $row = $res->fetch_all(MYSQLI_ASSOC);
    if($row == NULL){
        echo "您还没有收藏文献信息";
    }
    else{
        $paper_amount = count($row);
        for ($i=0; $i < $paper_amount; $i++){ 
            $pid = $row[$i]['id'];
            $paperinfosql = "SELECT name,available_date,jname FROM paper WHERE id = '$pid'";
            $paperinfores = $conn->query($paperinfosql);
            $paperinforow = $paperinfores->fetch_object();
            $row[$i]['id'] = $pid;
            $row[$i]['paper_name'] = $paperinforow->name;
            $authorinfosql = "SELECT name FROM author WHERE pid = '$pid'";
            $authorinfores = $conn->query($authorinfosql);
            $authorinforow = $authorinfores->fetch_all(MYSQLI_ASSOC);
            $row[$i]['author'] = $authorinforow;
            $row[$i]['publish_date'] = $paperinforow->available_date;
            $row[$i]['jname'] = $paperinforow->jname;
        }
        echo json_encode($row);
    }
?>