<?php
header("Content-Type: text/html;charset=utf-8");

$allowedExts = array("pdf", "PDF");
$temp = explode(".", $_FILES["upload_file"]["name"]);
// echo $_FILES["file"]["size"];
$extension = end($temp);     // 获取文件后缀名

if ( ($_FILES["upload_file"]["type"] == "application/pdf")
&& ($_FILES["upload_file"]["size"] < 20480000)   // 小于 200 kb
&& in_array($extension, $allowedExts)){

    if ($_FILES["upload_file"]["error"] > 0){
        echo "错误：" . $_FILES["upload_file"]["error"] . "<br>";
        print_r($_FILES["upload_file"]);
    }
    else{
        // echo "上传文件名: " . $_FILES["upload_file"]["name"] . "<br>";
        // echo "文件类型: " . $_FILES["upload_file"]["type"] . "<br>";
        // echo "文件大小: " . ($_FILES["upload_file"]["size"] / 1024) . " kB<br>";
        // echo "文件临时存储的位置: " . $_FILES["upload_file"]["tmp_name"];
        // echo $_FILES["upload_file"]["type"];

        if (file_exists("upload/" . $_FILES["upload_file"]["name"])){
            echo $_FILES["upload_file"]["name"] . " 文件已经存在。 ";
        }
        else{
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["upload_file"]["tmp_name"], "upload/" . $_FILES["upload_file"]["name"]);
            // echo "文件存储在: " . "upload/" . $_FILES["upload_file"]["name"];
        }

        $pyPATH = "C:\Users\jht20\AppData\Local\Programs\Python\Python37\python.exe";
        exec($pyPATH . " PDFparser.py " . $_FILES["upload_file"]["name"], $output);
        print_r($output);

    }
    
}else{
    echo "非法的文件格式";
}

?>