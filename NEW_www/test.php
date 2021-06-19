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
    }
    $papername = $_POST['paper_name'];
    //$authorstring = $_POST['author'];   //字符串，有很多个作者，用分号隔开
    //$institutionstring = $_POST['institution']; //字符串，有很多个单位，用分号隔开
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
    $authorcount = $_POST['total_au'];
    echo $authorcount;
    echo '<br>';
    //每个作者对应一个长字符串的单位信息，用循环语句得到
    $authorarray = $_POST['author'];
    $institutionarray = $_POST['institution'];
    echo $authorarray[0];
    echo $institutionarray[0];
    echo '<br>';
    echo $authorarray[1];
    echo $institutionarray[1];
    echo '<br>';  
    $institutionarray = array();
    for($i=0; $i < $authorcount; $i++){
        $string1 = (string)($i+1);
        $authorarray[$i] = $_POST['author' . "" . $string1 ];
        echo $authorarray[$i];
        $instiutionarray[$i] = $_POST['institution' . "" . $string1 ];
        echo $institutionarray[$i];
        echo '<br>';
    }
    echo '<br>';
    echo $papername;
    echo '<br>';
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
    $keywordarray = array();
    $keywordcount = 0;
    if($keywordsstring){
        $keywordarray = preg_split("/;/",$keywordsstring);  //得到一个数组，每个元素都是一个关键词
        $keywordcount = count($keywordarray);   //关键词数量
    }
    for($i=0; $i < $keywordcount; $i++){
        echo $keywordarray[$i];
        echo '<br>';
    }
    $j = 123;
    echo (string)$j;*/

    /*$username = "5aec5rW35aSp";
    $password = "*02DF60735CA7783BE624A6C9AE6092F6744D98C9";
    $selsql="SELECT username,password FROM user WHERE username = '$username' AND password = '$password'";
    $selres=$conn->query($selsql);
    $selrow=$selres->fetch_object();
    echo $selrow->password;
    echo '<br>';
    echo $password;
    header("location:index.html");*/
    //header("location:index.html");
    //session_start();
    //$username = $_SESSION['username'];
    //$name_encoded = base64_encode($username);
    //$name_encoded = session_id(); 
    //echo $name_encoded;
    //echo "hello world";
    /*$uidsql = "SELECT * FROM user WHERE username = 'aHV5aWZhbg=='";
    $uidres = $conn->query($uidsql);
    $row = $uidres->fetch_all(MYSQLI_ASSOC);
    //$count = count($uidres);
    if($row == NULL){
        echo '1';
    }
    else{
        echo '0';
    }
    //echo $count;
    echo base64_decode('aHV5aWZhbg==');*/
    /*$timesql = "SELECT DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s')";
    $timeres = $conn->query($timesql);
    $time = $timeres->fetch_row();
    $time = $time[0];   //获取添加的时间
    
    $insertsql = "INSERT favourite (`uid`, `pid`, `collect_time`) VALUES ('2', '31', '$time')";
    $send = $conn->query($insertsql);   //向favourite表中添加这条记录
    if ($send)
        echo '1';
    else
        echo '0';*/
    //$str = 'c3tv65iqc6h8nqb67u8hq2e1np';
    //echo base64_encode($str);
    $usr_input="work+kjbca=cwqcw-awcq_qcqc;aasc;avwev:cwce*vkb&bclebf(blb)nlnl%scc;wcdnl#ncln2/c2cqx,3c3vv`bkbbk<cwcwc>wdc3v3v.czqde'cl";
    $usr_inputarray = preg_split('/[\s+]|[\s=]|[\s-]|[\s_]|[\s;]|[\s:]|[\s*]|[\s&]|[\s(]|[\s)]|[\s%]|[\s#]|[\s,]|[\s`]|[\s<]|[\s>]|[\s.]|[\s`&#39`]/',$usr_input);  //处理分号
    $usr_inputcount = count($usr_inputarray);
    $proceed = $usr_inputarray[0];
    for($i=1; $i < $usr_inputcount; $i++)
    {
        $proceed = $proceed . "~" . $usr_inputarray[$i];
    }
    echo $proceed;
    /*$sql = "SELECT id FROM paper WHERE name LIKE ?";
    $stmt = $conn->prepare($sql);
    //绑定变量
    $usr_input = "%" . $usr_input . "%";
    $stmt->bind_param("s", $usr_input);
    $stmt->execute();
    $stmt->bind_result($id);
    $i=0;
    while ($stmt->fetch()) {
        $row[$i]['id'] = $id;
        $i++;
    }
    for ($i=0; $i < count($row); $i++){ 
        $pid = $row[$i]['id'];
        echo $row[$i]['id'];
        echo '<br>';
    }*/
    $username = base64_encode('abcdefg');
    $password = base64_encode('abcdefg');
    $sql = "SELECT username,password FROM user WHERE username = ? AND password=PASSWORD(?)";
    $stmt = $conn->prepare($sql);
    //通过绑定变量防止SQL注入
    $stmt->bind_param("ss", $username,$password);
    $stmt->execute();
    $stmt->bind_result($urname,$passwd);
    while ($stmt->fetch()) {
        $selrow['username'] = $urname;
        $selrow['$password'] = $passwd;
    }
    //echo $selrow['username'];
?>
