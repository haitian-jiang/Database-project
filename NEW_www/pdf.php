<?php
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
// echo $_FILES["file"]["size"];
$extension = end($temp);     // 获取文件后缀名

// if ((($_FILES["file"]["type"] == "image/gif")
// || ($_FILES["file"]["type"] == "image/jpeg")
// || ($_FILES["file"]["type"] == "image/jpg")
// || ($_FILES["file"]["type"] == "image/pjpeg")
// || ($_FILES["file"]["type"] == "image/x-png")
// || ($_FILES["file"]["type"] == "image/png"))
// && ($_FILES["file"]["size"] < 204800)   // 小于 200 kb
// && in_array($extension, $allowedExts))



if ($_FILES["file"]["error"] > 0)
{
    echo "错误：" . $_FILES["file"]["error"] . "<br>";
}
else
{
    echo "上传文件名: " . $_FILES["upload_file"]["name"] . "<br>";
    echo "文件类型: " . $_FILES["upload_file"]["type"] . "<br>";
    echo "文件大小: " . ($_FILES["upload_file"]["size"] / 1024) . " kB<br>";
    echo "文件临时存储的位置: " . $_FILES["upload_file"]["tmp_name"];
    echo $_FILES["upload_file"]["type"];
}
?>