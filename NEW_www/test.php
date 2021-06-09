<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件
    //resource mysql_query ( string $query [, resource $conn ] );
    $j_time = '20210413';
    $j_timestring = substr($j_time,4,2) . "/" . substr($j_time,6,2) . "/" . substr($j_time,0,4) . " " . '00:00:00';
    $date = strtotime($j_timestring);
    $jtime = date('Y-m-d H:i:s', $date);

    $string="php教程#php入门:教程#字符串:多分隔符#字符串:拆分#数组";
    $arr = preg_split("/(#|:)/",$string);

    /*function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (empty($_POST["author"])) {
        $author = "";
    } 
    else {
        $comment = test_input($_POST["author"]);
    }*/
    $papername = $_POST['paper_name'];
    $authorstring = $_POST['author'];   //字符串，有很多个作者，用分号隔开
    $institutionstring = $_POST['institution']; //字符串，有很多个单位，用分号隔开
    $keywordsstring = $_POST['keywords'];   //字符串，有很多个关键词，用分号隔开
    $publish_date = $_POST['publish_date'];  //字符串，8位数字，需转换为datetime类型
    $jname = $_POST['pname'];
    $j_time = $_POST['jtime'];   //字符串，8位数字，需转换为datetime类型
    $jplace = $_POST['jplace'];

    $available_date = substr($publish_date,0,4) . "-" . substr($publish_date,4,2) . "-" . substr($publish_date,6,2) . " " . '00:00:00';
    $jtime = substr($j_time,0,4) . "-" . substr($j_time,4,2) . "-" . substr($j_time,6,2) . " " . '00:00:00';
    //$add_into_paper_sql = "INSERT INTO `paper` (`name`, `available_date`, `jname`, `jtime`, `jplace`) VALUES ('$papername', '$available_date', '$jname', '$jtime', '$jplace')";
    //$add_into_paper_res = $conn->query($add_into_paper_sql);
    //插入paper表后得到paperid
    //$getpaperid_sql = "SELECT id FROM paper WHERE name='$papername' and available_date='$available_date' and jname='$jname' and jtime='$jtime' and jplace='$jplace'";
    //$getpaperid_res = $conn->query($getpaperid_sql);
    //$paperid = $getpaperid_res->fetch_object();
    //$pid = $paperid->id;
    //echo $pid;
    //echo '<br>';
    //echo $papername;
    $timesql = "SELECT DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s')";
    $timeres = $conn->query($timesql);
    $time = $timeres->fetch_row();
    $time = $time[0];
    echo $time;
    echo '<br>';
    
    //$institutionstring = $_POST['institution']; //字符串，有很多个单位，用分号隔开
    echo $authorstring;
    echo '<br>';
    //echo $institutionstring;
    echo '<br>';
    $institutionarray = preg_split("/;/",$institutionstring);  //得到一个数组，每个元素都是一个关键词
    echo $institutionarray[0];
    echo '<br>';
    echo $institutionarray[1];
    echo '<br>';
    //echo $institutionstring;
    //echo '<br>';

    session_start();
    //$username = $_SESSION('username');
    //$userid = base64_encode($username);  //查找此姓名对应的id
    //print("");
    $sid = session_id();
    //$tid = $_COOKIE[$sid];
    //$sid = SID;
    echo $sid;
    echo '<br>';
    //echo $tid;
    //$username = $_SESSION['username'];
    //$name_encoded = base64_encode($username);//查找此姓名对应的id
    //$userid = base64_encode($username);//查找此姓名对应的id
    //echo $userid;
    //print("Session ID returned by session_id(): ".$sid."\n");
    //echo $keywordsstring;
    //echo '<br>';
    //echo $publish_date;
    //echo '<br>';
    //echo $jname;
    //echo '<br>';
    //echo $j_time;
    //echo '<br>';
    //echo $jplace;
    $keywordarray = preg_split("/;/",$keywordsstring);  //得到一个数组，每个元素都是一个关键词
    $keywordcount = count($keywordarray);   //关键词数量
    echo $keywordcount;
    echo '<br>';
    echo $keywordarray[0];
    echo '<br>';
    echo $keywordarray[1];
    echo '<br>';
?>
