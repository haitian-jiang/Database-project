<?php
    header('Content-type:text/html;charset=utf-8');
    session_start();
    if(isset($_SESSION['username'])){
        //$_SESSION['username'];
        session_unset();
        session_destroy();//销毁一个会话中的全部数据
        setcookie(session_name(),'');//销毁与客户端的联系
        echo "<script>alert('注销成功');parent.location.href='login.html';</script>";
    }
    else{
        echo "<script>alert('您还尚未登录');parent.location.href='login.html';</script>";
    }
?>