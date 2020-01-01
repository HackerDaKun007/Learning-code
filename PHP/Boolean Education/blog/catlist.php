<?php

//引入公共文件
require('./public.php');

//查询数据
$sql = "select * from cat";
$rs = mysqlQuery($conn,$sql);
$cat = [];
while($row = mysqli_fetch_assoc($rs))
{
    $cat[] = $row;
};

require('./view/admin/artlist.html');
?>