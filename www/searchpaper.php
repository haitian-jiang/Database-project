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
                $sql = "SELECT * FROM paper WHERE name = '$usr_input'";
                $res = $conn->query($sql);
                $row = $res->fetch_all(MYSQLI_ASSOC);
                if($row == NULL){
                    echo "PC404";
                }
                else{
                    $paper_amount = count($row);
                    for ($i=0; $i < $paper_amount; $i++) { 
                        $id = $row[$i]['id'];
                        $paperinfosql = "SELECT paper.name,author.name,paper.available_date,paper.jname,author.institution,keyword.keyword,paper.jtime,paper.jplace FROM paper inner join keyword on paper.id=keyword.pid inner join author on paper.id=author.pid WHERE id = $pid";
                        $paperinfores = $conn->query($paperinfosql);
                        $paperinforow = $paperinfores->fetch_object();
                        $row[$i]['name'] = $paperinforow->paper.name;
                        $row[$i]['author'] = $paperinforow->author.name;
                        $row[$i]['available_date'] = $paperinforow->paper.available_date;
                        $row[$i]['jname'] = $paperinforow->paper.jname;
                        $row[$i]['institution'] = $paperinforow->author.institution;
                        $row[$i]['keyword'] = $paperinforow->keyword.keyword;
                        $row[$i]['jtime'] = $paperinforow->paper.jtime;
                        $row[$i]['jplace'] = $paperinforow->paper.jplace;
                    }
                    echo json_encode($row);
                }
                break;

            case "author"://用户按照论文作者，即数据库中author表的name查询
                $sql = "SELECT * FROM author WHERE name = '$usr_input'";
                $res = $conn->query($sql);
                $row = $res->fetch_all(MYSQLI_ASSOC);
                if($row == NULL){
                    echo "PC404";
                }
                else{
                    $paper_amount = count($row);
                    for ($i=0; $i < $paper_amount; $i++) { 
                        $pid = $row[$i]['pid'];
                        $paperinfosql = "SELECT paper.name,author.name,paper.available_date,paper.jname,author.institution,keyword.keyword,paper.jtime,paper.jplace FROM paper inner join keyword on paper.id=keyword.pid inner join author on paper.id=author.pid WHERE id = $pid";
                        $paperinfores = $conn->query($paperinfosql);
                        $paperinforow = $paperinfores->fetch_object();
                        $row[$i]['name'] = $paperinforow->paper.name;
                        $row[$i]['author'] = $paperinforow->author.name;
                        $row[$i]['available_date'] = $paperinforow->paper.available_date;
                        $row[$i]['jname'] = $paperinforow->paper.jname;
                        $row[$i]['institution'] = $paperinforow->author.institution;
                        $row[$i]['keyword'] = $paperinforow->keyword.keyword;
                        $row[$i]['jtime'] = $paperinforow->paper.jtime;
                        $row[$i]['jplace'] = $paperinforow->paper.jplace;
                    }
                    echo json_encode($row);
                }
                break;

            case "institution"://用户按照单位，即数据库中author表的institution查询
                $sql = "SELECT * FROM author WHERE institution = '$usr_input'";
                $res = $conn->query($sql);
                $row = $res->fetch_all(MYSQLI_ASSOC);
                if($row == NULL){
                    echo "PC404";
                }
                else{
                    $paper_amount = count($row);
                    for ($i=0; $i < $paper_amount; $i++) { 
                        $pid = $row[$i]['pid'];
                        $paperinfosql = "SELECT paper.name,author.name,paper.available_date,paper.jname,author.institution,keyword.keyword,paper.jtime,paper.jplace FROM paper inner join keyword on paper.id=keyword.pid inner join author on paper.id=author.pid WHERE id = $pid";
                        $paperinfores = $conn->query($paperinfosql);
                        $paperinforow = $paperinfores->fetch_object();
                        $row[$i]['name'] = $paperinforow->paper.name;
                        $row[$i]['author'] = $paperinforow->author.name;
                        $row[$i]['available_date'] = $paperinforow->paper.available_date;
                        $row[$i]['jname'] = $paperinforow->paper.jname;
                        $row[$i]['institution'] = $paperinforow->author.institution;
                        $row[$i]['keyword'] = $paperinforow->keyword.keyword;
                        $row[$i]['jtime'] = $paperinforow->paper.jtime;
                        $row[$i]['jplace'] = $paperinforow->paper.jplace;
                    }
                    echo json_encode($row);
                }
                break;

            case "journal"://用户按照期刊,会议，即数据库中paper表的jname查询
                $sql = "SELECT * FROM paper WHERE jname = '$usr_input'";
                $res = $conn->query($sql);
                $row = $res->fetch_all(MYSQLI_ASSOC);
                if($row == NULL){
                    echo "PC404";
                }
                else{
                    $paper_amount = count($row);
                    for ($i=0; $i < $paper_amount; $i++) { 
                        $pid = $row[$i]['id'];
                        $paperinfosql = "SELECT paper.name,author.name,paper.available_date,paper.jname,author.institution,keyword.keyword,paper.jtime,paper.jplace FROM paper inner join keyword on paper.id=keyword.pid inner join author on paper.id=author.pid WHERE id = $pid";
                        $paperinfores = $conn->query($paperinfosql);
                        $paperinforow = $paperinfores->fetch_object();
                        $row[$i]['name'] = $paperinforow->paper.name;
                        $row[$i]['author'] = $paperinforow->author.name;
                        $row[$i]['available_date'] = $paperinforow->paper.available_date;
                        $row[$i]['jname'] = $paperinforow->paper.jname;
                        $row[$i]['institution'] = $paperinforow->author.institution;
                        $row[$i]['keyword'] = $paperinforow->keyword.keyword;
                        $row[$i]['jtime'] = $paperinforow->paper.jtime;
                        $row[$i]['jplace'] = $paperinforow->paper.jplace;
                    }
                    echo json_encode($row);
                }
                break;

            case "publish_date"://用户按照发表日期，即数据库中paper表的available_date查询
                $sql = "SELECT * FROM paper WHERE available_date = '$usr_input'";
                $res = $conn->query($sql);
                $row = $res->fetch_all(MYSQLI_ASSOC);
                if($row == NULL){
                    echo "PC404";
                }
                else{
                    $paper_amount = count($row);
                    for ($i=0; $i < $paper_amount; $i++) { 
                        $pid = $row[$i]['id'];
                        $paperinfosql = "SELECT paper.name,author.name,paper.available_date,paper.jname,author.institution,keyword.keyword,paper.jtime,paper.jplace FROM paper inner join keyword on paper.id=keyword.pid inner join author on paper.id=author.pid WHERE id = $pid";
                        $paperinfores = $conn->query($paperinfosql);
                        $paperinforow = $paperinfores->fetch_object();
                        $row[$i]['name'] = $paperinforow->paper.name;
                        $row[$i]['author'] = $paperinforow->author.name;
                        $row[$i]['available_date'] = $paperinforow->paper.available_date;
                        $row[$i]['jname'] = $paperinforow->paper.jname;
                        $row[$i]['institution'] = $paperinforow->author.institution;
                        $row[$i]['keyword'] = $paperinforow->keyword.keyword;
                        $row[$i]['jtime'] = $paperinforow->paper.jtime;
                        $row[$i]['jplace'] = $paperinforow->paper.jplace;
                    }
                    echo json_encode($row);
                }
                break;

            case "keywords"://用户按照关键字，即数据库中keyword表的keyword查询
                $sql = "SELECT * FROM keyword WHERE keyword = '$usr_input'";
                $res = $conn->query($sql);
                $row = $res->fetch_all(MYSQLI_ASSOC);
                if($row == NULL){
                    echo "PC404";
                }
                else{
                    $paper_amount = count($row);
                    for ($i=0; $i < $paper_amount; $i++) { 
                        $pid = $row[$i]['pid'];
                        //$user_id = $row[$i]['user_id']; 
                        $paperinfosql = "SELECT paper.name,author.name,paper.available_date,paper.jname,author.institution,keyword.keyword,paper.jtime,paper.jplace FROM paper inner join keyword on paper.id=keyword.pid inner join author on paper.id=author.pid WHERE id = $pid";
                        $paperinfores = $conn->query($paperinfosql);
                        $paperinforow = $paperinfores->fetch_object();
                        $row[$i]['name'] = $paperinforow->paper.name;
                        $row[$i]['author'] = $paperinforow->author.name;
                        $row[$i]['available_date'] = $paperinforow->paper.available_date;
                        $row[$i]['jname'] = $paperinforow->paper.jname;
                        $row[$i]['institution'] = $paperinforow->author.institution;
                        $row[$i]['keyword'] = $paperinforow->keyword.keyword;
                        $row[$i]['jtime'] = $paperinforow->paper.jtime;
                        $row[$i]['jplace'] = $paperinforow->paper.jplace;
                    }
                    echo json_encode($row);
                }
                break;

        }
    }
?>