<?php
    header("content-type:text/html;charset=utf-8");  //设置页面内容是html  编码是utf-8
    error_reporting(E_ALL &~ E_NOTICE);     //屏蔽错误信息
    include 'connect.php';     //调用数据库连接文件
    //$password=base64_encode($_POST['password']);     //接收前台post值
    $username=base64_encode($_POST['username']);
    $password = $_POST['password'];

    if ($username == "" || $password == "")      //判断用户名和密码是否为空
    {
		echo "<script>alert('输入格式错误');history.back();</script>";
    }
	else
    {
		$selsql="SELECT username,password FROM user WHERE username = '$username' AND password='$password'";
        $selres=$conn->query($selsql);
        $selrow=$selres->fetch_object();
        if ($selrow->username == $username){
			echo "登录成功<br>";
			if (empty($_COOKIE['PHPSESSID'])) {
 				session_set_cookie_params($expire);
 				session_start();
 			}
 			else{
 				session_start();
 				setcookie('PHPSESSID', session_id(), time() + $expire);
 			}
 			if(isset($_SESSION['username']) && ($_SESSION['username']==$selrow->username)){
 				exit("您已经登入了，请不要重新登入！用户名：{$_SESSION['username']}---<a href='logoff.php'>注销</a>");
 			}
            else{
 				$_SESSION['username'] = $_POST['username'];
 			}
            header("location:index.html");
        }
        else{
			echo "<script>alert('LOGIN ERROR');history.back();</script>";
		}

    }
    /*session_start();
    $username = $_SESSION['username'];
    $name_encoded = base64_encode($username); 
    //$name_encoded = session_id(); 
    echo $name_encoded;
    echo '<br>';
    echo "hello world!";
    $idsql="SELECT id FROM user WHERE username = '$name_encoded'";
    $idres=$conn->query($idsql);
    $idrow=$idres->fetch_object();
    echo $idrow->id;*/
?>
