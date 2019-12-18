<?php

$data = $_POST;
if(empty($data)){ 
    require('./view/admin/catadd.html');
}else{
    // print_r($data);
    //连接数据库
    $conn = mysqli_connent('127.0.0.1','root','123123');
}

?>