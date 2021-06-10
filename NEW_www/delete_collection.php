<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件

    $pid = $_POST['paper_id'];     //接收前台post值
    session_start();
    $username = $_SESSION['username'];
    $name_encoded = base64_encode($username);  
    $uidsql = "SELECT * FROM user WHERE username = '$name_encoded'";
    $uidres = $conn->query($uidsql);
    $uidrow = $uidres->fetch_object();
    $uid = $uidrow->id;
    
    $deletesql = "DELETE FROM favourite WHERE uid = '$uid' and pid = '$pid'"; //删除指定用户id和论文id的记录
    $send = $conn->query($deletesql);   //从favourite表中删除这条记录
    if ($send)
        echo true;
    else
        echo false;

    //是否需要在前端页面立即删除这条收藏记录,如需要，更新前端信息
    /*$sql = "SELECT * FROM favourite WHERE uid = '$name_encoded'";
    $res = $conn->query($sql);
    $row = $res->fetch_all(MYSQLI_ASSOC);
    if($row == NULL){
        echo "您没有其他收藏的文献信息哦";
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
    }*/


?>