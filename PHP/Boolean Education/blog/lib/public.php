<?php

 //设置页面字符集
header('Content-Type:text/html;charset=utf-8');
//header('Refresh:3,Url=catadd.php');



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