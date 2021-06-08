<?php
    $j_time = '20210413';
    $j_timestring = substr($j_time,4,2) . "/" . substr($j_time,6,2) . "/" . substr($j_time,0,4) . " " . '00:00:00';
    $date = strtotime($j_timestring);
    $jtime = date('Y-m-d H:i:s', $date);

    $string="php教程#php入门:教程#字符串:多分隔符#字符串:拆分#数组";
    $arr = preg_split("/(#|:)/",$string);

    $authorstring = $_POST['author'];   //字符串，有很多个作者，用分号隔开
    $institutionstring = $_POST['institution']; //字符串，有很多个单位，用分号隔开
    echo $authorstring;
    echo $institutionstring;

?>
