<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件
    $username=$_POST['username'];
    $password=$_POST['password'];
    //echo base64_encode($username);
    //echo '<br>';
    //echo base64_encode($password);
    $usernamearray = preg_split('/[\s+]|[\s=]|[\s-]|[\s_]|[\s;]|[\s:]|[\s*]|[\s&]|[\s(]|[\s)]|[\s%]|[\s#]|[\s,]|[\s`]|[\s<]|[\s>]|[\s.]/',$username);  //处理分号,不允许带特殊符号的用户名，以防止可能产生的SQL注入
    $usernamecount = count($usernamearray);
    if ($username == "" || $password == ""){
		echo "<script>alert('输入格式错误');history.back();</script>";
    }
	else
    {
        if ($usernamecount > 1){
            echo "<script>alert('不允许使用带有特殊字符的用户名');history.back();</script>";
        }
        else{
            $name_encoded = base64_encode($username);
            $passwd_encoded = base64_encode($password);
            $uidsql = "SELECT * FROM user WHERE username = '$name_encoded'";
            $uidres = $conn->query($uidsql);
            $uidrow = $uidres->fetch_all(MYSQLI_ASSOC);
            if($uidrow == NULL){
                $codepasswdsql = "SELECT PASSWORD('$passwd_encoded')";
                $codepasswdres = $conn->query($codepasswdsql);
                $codepasswd = $codepasswdres->fetch_row();
                $codepasswd = $codepasswd[0];   //获取加密后的密码
                $addusersql = "INSERT user (`username`, `password`) VALUES ('$name_encoded', '$codepasswd')";
                $adduserres = $conn->query($addusersql);   //向user表中添加这个用户
                if ($adduserres){
                    echo "<script> alert('注册成功');parent.location.href='login.html'; </script>";
                }
                else{
                    echo "<script>alert('注册失败');history.back();</script>";
                }
            }
            else{
                echo "<script>alert('该用户已存在');history.back();</script>";
            }
        }
    }
?>
