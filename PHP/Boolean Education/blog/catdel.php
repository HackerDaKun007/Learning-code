<?php
/**
 * 删除数据
*/

require('./public.php');

$data = arrayMap($_GET);
if(empty($data['id']) || !is_numeric($data['id'])){
    frontEndBack('数据异常');
}

$sql = 'delete from cat where cart_id='.$data['id'];
if(mysqlQuery($conn,$sql)){ //删除成功
    //删除文字列表
    mysqlQuery($conn,'delete from art where cat_id='.$data['id']);
    verificationJump('删除成功','/catlist.php');
}else{
    frontEndBack('删除失败');
}


dieMysql();

?>