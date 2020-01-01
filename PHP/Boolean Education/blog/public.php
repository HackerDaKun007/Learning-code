<?php

 //设置页面字符集
header('Content-Type:text/html;charset=utf-8');
//header('Refresh:3,Url=catadd.php');
static $conn = null;
if($conn === null){
    //连接数据库
    $conn = mysqli_connect('127.0.0.1','root','123123','blog','3306');
    if(!$conn){
        mysqlLog(mysqli_connect_error());
        exit('连接失败'.mysqli_connect_error());
    }
}

//设置数据库字符集
mysqli_set_charset($conn,'utf8');



/* 
* 后退方法
* @$val string 弹出信息
*/
function frontEndBack($val)
{

    exit('<script>alert("'.$val.'");history.go(-1);</script>');
}

/** 
 * 跳转页面
 * $val string 弹出信息
 * $url string  传入跳转的地址 
*/
function verificationJump($val,$url)
{
    exit('<script>alert("'.$val.'");window.location.href="'.$url.'"</script>');
}

/* 
* 断开mysql连接
* @conn object  连接mysql的变量对象
*/
function dieMysql($conn)
{
    mysqli_close($conn);
}



/**
 * mysqli_query查询数据
 * @param $conn object 连接mysql对象变量
 * @param $sql str mysql查询字符串
*/
function mysqlQuery($conn,$sql)
{
    $rs = mysqli_query($conn,$sql);
    if($rs){
        mysqlLog($sql);
    }else{
        mysqlLog($sql.'\n'.mysqli_error($conn));
    }
    return $rs;
}

/**
 * log mysql日志功能
 * @param str 待记录的字符串
*/
function mysqlLog($sql)
{
    $filename = __DIR__.'/log/'.date('Ymd').'.txt';
    $log = "---------------------------------------------------\n".date('Y/m/d H:i:s')."\n".$sql."\n---------------------------------------------------\n\n";
    file_put_contents($filename,$log,FILE_APPEND);
}

/**
*  清除数组左右两边空格
* $val arrar 传入一组一维数组
*/
function arrayMap($val)
{
    if (!is_array($val)){
        return trim($val);
    }
    return array_map('arrayMap', $val);
}

?>