<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件

    $papername = $_POST['paper_name'];
    $authorcount = $_POST['total_au'];  //得到作者数量
    $authorarray = $_POST['author'];   //数组，很多个作者
    $institutionarray = $_POST['institution']; //数组，很多个单位，每个作者对应一个单位
    $keywordsstring = $_POST['keywords'];   //字符串，有很多个关键词，用分号隔开
    $publish_date = $_POST['publish_date']; //字符串，8位数字，需转换为datetime类型
    $jname = $_POST['pname'];
    $j_time = $_POST['jtime'];   //字符串，8位数字，需转换为datetime类型
    $jplace = $_POST['jplace'];

    $available_date = substr($publish_date,0,4) . "-" . substr($publish_date,4,2) . "-" . substr($publish_date,6,2) . " " . '00:00:00';
    $jtime = substr($j_time,0,4) . "-" . substr($j_time,4,2) . "-" . substr($j_time,6,2) . " " . '00:00:00';    
    $keywordcount = 0;
    if($keywordsstring){
        $keywordarray = preg_split("/;/",$keywordsstring);  //得到一个数组，每个元素都是一个关键词
        $keywordcount = count($keywordarray);   //关键词数量
    }
    //将属于paper表的信息插入paper表
    $add_into_paper_sql = "INSERT INTO `paper` (`name`, `available_date`, `jname`, `jtime`, `jplace`) VALUES ('$papername', '$available_date', '$jname', '$jtime', '$jplace')";
    $add_into_paper_res = $conn->query($add_into_paper_sql);
    //插入paper表后得到paperid
    $getpaperid_sql = "SELECT id FROM paper WHERE name='$papername' and available_date='$available_date' and jname='$jname' and jtime='$jtime' and jplace='$jplace'";
    $getpaperid_res = $conn->query($getpaperid_sql);
    $paperid = $getpaperid_res->fetch_object();
    $pid = $paperid->id;

    //向author表中插入记录
    for($i=0; $i < $authorcount; $i++){
        $add_into_author_sql = "INSERT INTO `author` (`pid`, `name`, `institution`) VALUES ('$pid', '$authorarray[$i]', '$institutionarray[$i]')";
        $add_into_author_res = $conn->query($add_into_author_sql);
    }
    //向keyword表中插入记录
    for($i=0; $i < $keywordcount; $i++){
        $add_into_keyword_sql = "INSERT INTO `keyword` (`pid`, `keyword`) VALUES ('$pid', '$keywordarray[$i]')";
        $add_into_keyword_res = $conn->query($add_into_keyword_sql);
    }
    if($pid)
        echo '1';
    else
        echo '0';

?>