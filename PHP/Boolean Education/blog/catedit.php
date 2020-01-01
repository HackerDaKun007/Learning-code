<?php
/**
 * 修改栏目数据数据
 * 
*/
require('./public.php');
$data = arrayMap($_GET);

if($_POST){
    $data = arrayMap($_POST);
    if(!empty($data['id']) && is_numeric($data['id']) && !empty($data['carname'])){
        //判断栏目数据是否存在
        $sql = "select count(*) from cat where carname='$data[carname]' and cart_id !='$data[id]'";
        $rs = mysqlQuery($conn,$sql);
        $carname = mysqli_fetch_row($rs);
        if($carname[0] > 0){
            frontEndBack('栏目名称已存在');
        }
        $sql = "update cat set carname='$data[carname]' where cart_id='$data[id]'";
        if(mysqlQuery($conn,$sql)){
            verificationJump('修改成功','/catlist.php');
        }else{
            frontEndBack('修改失败'.mysqli_error($conn));
        }
    }
}

if(!empty($data['id']) && is_numeric($data['id'])){
    $sql = 'select cart_id,carname from cat where cart_id='.$data['id'];
    $rs = mysqlQuery($conn,$sql);
    if(!empty($rs)){
        $car = mysqli_fetch_assoc($rs);
        require('./view/admin/catedit.html');
        exit;
    }
} 


frontEndBack('数据异常');
?>