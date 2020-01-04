<?php
//引入公共文件文件
require('./public.php');
$data = $_POST;
if(empty($data)){ 
    require('./view/admin/catadd.html');
}else{
    $data = arrayMap($data);  //获取数据，并过滤数据
    //验证数据
    if(empty($data['catname'])){
       frontEndBack('栏目名称不能为空');
    }
    //检查栏目是否存在,查询返回只是否为0，存在就返回当前同样的名的长度
    $sql = "select count(*) from cat where carname='$data[catname]'";
    $rs = mysqlCount($conn,$sql);
    if($rs > 0){
        frontEndBack('栏目名称已存在');
    }

    //写入数据
    $sql = "insert into cat(carname,num) values ('$data[catname]',1)";
    $data_sql = mysqlQuery($conn,$sql);
    if(!$data_sql){
        $error = mysqli_error($conn);
        frontEndBack("栏目插入失败 失败原因:$error");
    }else{
        verificationJump('栏目插入成功','/catadd.php');
    };
}


// 断开mysql
dieMysql($conn);
?>