<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件
    $method = $_POST['method'];
    $usr_input = $_POST['usr_input'];//接收前台post值
    if ($usr_input == "") {     //判断输入是否为空
        echo "<script>alert('输入格式错误');history.back();</script>";
    }
    else{
        switch ($method) {
            case "paper_name"://用户按照论文名称，即数据库中paper表的name查询
                $sql = "SELECT * FROM paper WHERE name LIKE '%$usr_input%'";
                $res = $conn->query($sql);
                $row = $res->fetch_all(MYSQLI_ASSOC);
                if($row == NULL){
                    echo "PC404";
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
                        $row[$i]['publish_date'] = substr($paperinforow->available_date,0,10);
                        $row[$i]['jname'] = $paperinforow->jname;
                    }
                    echo json_encode($row);
                }
                break;

            case "author"://用户按照论文作者，即数据库中author表的name查询
                $sql = "SELECT pid FROM author WHERE name LIKE '%$usr_input%'";
                $res = $conn->query($sql);
                $row = $res->fetch_all(MYSQLI_ASSOC);
                if($row == NULL){
                    echo "PC404";
                }
                else{
                    $paper_amount = count($row);
                    for ($i=0; $i < $paper_amount; $i++) { 
                        $pid = $row[$i]['pid'];
                        $paperinfosql = "SELECT name,available_date,jname FROM paper WHERE id = '$pid'";
                        $paperinfores = $conn->query($paperinfosql);
                        $paperinforow = $paperinfores->fetch_object();
                        $row[$i]['id'] = $pid;
                        $row[$i]['paper_name'] = $paperinforow->name;
                        $authorinfosql = "SELECT name FROM author WHERE pid = '$pid'";
                        $authorinfores = $conn->query($authorinfosql);
                        $authorinforow = $authorinfores->fetch_all(MYSQLI_ASSOC);
                        $row[$i]['author'] = $authorinforow;
                        $row[$i]['publish_date'] = substr($paperinforow->available_date,0,10);
                        $row[$i]['jname'] = $paperinforow->jname;
                    }
                    echo json_encode($row);
                }
                break;

            case "institution"://用户按照单位，即数据库中author表的institution查询
                $sql = "SELECT * FROM author WHERE institution LIKE '%$usr_input%'";
                $res = $conn->query($sql);
                $row = $res->fetch_all(MYSQLI_ASSOC);
                if($row == NULL){
                    echo "PC404";
                }
                else{
                    $paper_amount = count($row);
                    for ($i=0; $i < $paper_amount; $i++) { 
                        $pid = $row[$i]['pid'];
                        $paperinfosql = "SELECT name,available_date,jname FROM paper WHERE id = '$pid'";
                        $paperinfores = $conn->query($paperinfosql);
                        $paperinforow = $paperinfores->fetch_object();
                        $row[$i]['id'] = $pid;
                        $row[$i]['paper_name'] = $paperinforow->name;
                        $authorinfosql = "SELECT name FROM author WHERE pid = '$pid'";
                        $authorinfores = $conn->query($authorinfosql);
                        $authorinforow = $authorinfores->fetch_all(MYSQLI_ASSOC);
                        $row[$i]['author'] = $authorinforow;
                        $row[$i]['publish_date'] = substr($paperinforow->available_date,0,10);
                        $row[$i]['jname'] = $paperinforow->jname;
                    }
                    echo json_encode($row);
                }
                break;

            case "journal"://用户按照期刊,会议，即数据库中paper表的jname查询
                $sql = "SELECT * FROM paper WHERE jname LIKE '%$usr_input%'";
                $res = $conn->query($sql);
                $row = $res->fetch_all(MYSQLI_ASSOC);
                if($row == NULL){
                    echo "PC404";
                }
                else{
                    $paper_amount = count($row);
                    for ($i=0; $i < $paper_amount; $i++) { 
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
                        $row[$i]['publish_date'] = substr($paperinforow->available_date,0,10);
                        $row[$i]['jname'] = $paperinforow->jname;
                    }
                    echo json_encode($row);
                }
                break;

            case "publish_date"://用户按照发表日期，即数据库中paper表的available_date查询
                $j_time = $usr_input;
                $j_timestring = substr($j_time,0,4) . "-" . substr($j_time,4,2) . "-" . substr($j_time,6,2) . " " . '00:00:00';
                //$date = strtotime($j_timestring);
                //$jtime = date('Y-m-d H:i:s', $date);
                $sql = "SELECT * FROM paper WHERE available_date = '$j_timestring'";
                $res = $conn->query($sql);
                $row = $res->fetch_all(MYSQLI_ASSOC);
                if($row == NULL){
                    echo "PC404";
                }
                else{
                    $paper_amount = count($row);
                    for ($i=0; $i < $paper_amount; $i++) { 
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
                        $row[$i]['publish_date'] = substr($paperinforow->available_date,0,10);
                        $row[$i]['jname'] = $paperinforow->jname;
                    }
                    echo json_encode($row);
                }
                break;

            case "keywords"://用户按照关键字，即数据库中keyword表的keyword查询
                $sql = "SELECT * FROM keyword WHERE keyword LIKE '%$usr_input%'";
                $res = $conn->query($sql);
                $row = $res->fetch_all(MYSQLI_ASSOC);
                if($row == NULL){
                    echo "PC404";
                }
                else{
                    $paper_amount = count($row);
                    for ($i=0; $i < $paper_amount; $i++) { 
                        $pid = $row[$i]['pid'];
                        $paperinfosql = "SELECT name,available_date,jname FROM paper WHERE id = '$pid'";
                        $paperinfores = $conn->query($paperinfosql);
                        $paperinforow = $paperinfores->fetch_object();
                        $row[$i]['id'] = $pid;
                        $row[$i]['paper_name'] = $paperinforow->name;
                        $authorinfosql = "SELECT name FROM author WHERE pid = '$pid'";
                        $authorinfores = $conn->query($authorinfosql);
                        $authorinforow = $authorinfores->fetch_all(MYSQLI_ASSOC);
                        $row[$i]['author'] = $authorinforow;
                        $row[$i]['publish_date'] = substr($paperinforow->available_date,0,10);
                        $row[$i]['jname'] = $paperinforow->jname;
                    }
                    echo json_encode($row);
                }
                break;

        }
    }
?>