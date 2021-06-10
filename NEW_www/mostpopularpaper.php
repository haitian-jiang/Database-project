<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件

    $sql = "SELECT pid,COUNT(*) AS favorcount FROM favourite GROUP BY pid ORDER BY favorcount DESC limit 5";
    $res = $conn->query($sql);
    $row = $res->fetch_all(MYSQLI_ASSOC);
    for($i=0; $i<5; $i++){
        if($row[$i]['pid']){
            $row[$i]['id'] = $i + 1;
        }
        //echo $row[$i]['id'];
        $pid = $row[$i]['pid'];
        $paperinfosql = "SELECT name FROM paper WHERE id = '$pid'";
        $paperinfores = $conn->query($paperinfosql);
        $paperinforow = $paperinfores->fetch_object();
        $row[$i]['paper_name'] = $paperinforow->name;
        //echo $row[$i]['paper_name'];
        //echo '<br>';
    }
    echo json_encode($row); //返还格式：id(序号),paper_name(论文题目)
?>