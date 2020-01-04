<?php

//引入公共文件
require('./public.php');
//查询数据
$sql = "select * from cat";
$cat = mysqlSelect($conn,$sql);

require('./view/admin/artlist.html');

// 断开mysql
dieMysql($conn);
?>