<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    $username=$_POST['username'];
    $password=$_POST['password'];
    if ($username == "" || $password == "")
    {
		echo "<script>alert('输入格式错误');history.back();</script>";
    }
	else
    {
        $name_encoded = base64_encode($username);
        $passwd_encoded = base64_encode($password);
        $uidsql = "SELECT * FROM user WHERE username = '$name_encoded'";
        $uidres = $conn->query($uidsql);
        $uidrow = $uidres->fetch_object();
        $uid = $uidrow->id;
        if($uid){
            echo false;
        }
        else{
            $addusersql = "INSERT user (`username`, `password`) VALUES ('$name_encoded', '$passwd_encoded')";
            $adduserres = $conn->query($addusersql);   //向user表中添加这个用户
            if ($adduserres)
                echo true;
            else
                echo false;
        }
        /*$commandd = "add_user -c I_am_the_admin -u $username -p $password -n $username -m example@example.com -g 5";
        $socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
        socket_connect($socket,'123.57.252.230',8888);
        socket_write($socket, strlen($commandd).$commandd);
        $tmp_res = socket_read($socket, 204800);
        $res = substr($tmp_res, 6, substr($tmp_res, 0, 6));*/      
    }
?>
