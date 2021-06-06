<?php


header("content-type:text/html;charset=utf-8");

$allowedExts = array("pdf", "PDF");
$temp = explode(".", $_FILES["upload_file"]["name"]);
// echo $_FILES["file"]["size"];
$extension = end($temp);     // 获取文件后缀名

if ( ($_FILES["upload_file"]["type"] == "application/pdf")
&& ($_FILES["upload_file"]["size"] < 20480000)   // 小于 200 kb
&& in_array($extension, $allowedExts)){

    if ($_FILES["upload_file"]["error"] > 0){
        echo "#ERROR# " . $_FILES["upload_file"]["error"] . "<br>";
        // print_r($_FILES["upload_file"]);
    }else{

        if (file_exists("upload/" . $_FILES["upload_file"]["name"])){
            echo "#ERROR# " . $_FILES["upload_file"]["name"] . " 文件已经存在。 ";
        }
        else{
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["upload_file"]["tmp_name"], "upload/" . $_FILES["upload_file"]["name"]);
        }

        $pyPATH = "C:\Program Files (x86)\Microsoft Visual Studio\Shared\Python37_64\python.exe";
        exec($pyPATH . " PDFparser.py " . $_FILES["upload_file"]["name"], $output);
        // $metadata = json_decode($output[0], true);
        // echo json_encode($metadata);
        echo ($output[0]);
    }
    
}else{
    echo "#ERROR# NOT_A_FILE";
}
?>