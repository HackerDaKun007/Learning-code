<?php
/**
 * mysql.php MySQL操作的系列函数
 * @author 吴坤盛 <1275263021@qq.com>
 */

 /**
  * 连接数据库
  * @return resource 成功返回一个资源
  */
function mConn()
{
    //定义静态变量使得，mysql连接在同一个页面上只连接一次
    static $conn = null;
    if($conn === null){
        //连接数据库
        $conn = mysqli_connect('127.0.0.1','root','123123','blog','3306');
        //设置数据库字符集
        mysqli_set_charset($conn,'utf8');
        if(!$conn){
            mysqlLog(mysqli_connect_error());
            exit('连接失败'.mysqli_connect_error());
        }
    }
    return $conn;
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
 * mysqli_query查询一条数据
 * @param object $conn 连接mysql对象变量
 * @param string $sql mysql查询字符串
 * @return 
*/
function mysqlFind($conn,$sql)
{
    $rs = mysqli_query($conn,$sql);
    if($rs){
        mysqlLog($sql);
    }else{
        mysqlLog($sql.'\n'.mysqli_error($conn));
    }
    return mysqli_fetch_row($rs);
}

/**
 * mysqli_query返回长度
 * @param object $conn 连接mysql对象变量
 * @param string $sql mysql查询字符串
 * @return 
*/
function mysqlCount($conn,$sql)
{
    $rs = mysqli_query($conn,$sql);
    if($rs){
        mysqlLog($sql);
    }else{
        mysqlLog($sql.'\n'.mysqli_error($conn));
    }
    $sql =  mysqli_fetch_row($rs);
    if(!empty($sql[0]) && is_numeric($sql[0])){
        return $sql[0];   
    }
    return 0;
}

/**
 * mysqli_query 返回查询结果
 * @param object $conn 连接mysql对象变量
 * @param string $sql mysql查询字符串
 * @return 
*/
function mysqlQuery($conn,$sql)
{
    $rs = mysqli_query($conn,$sql);
    if($rs){
        mysqlLog($sql);
    }else{
        mysqlLog($sql.'\n'.mysqli_error($conn));
    }
    // $sql =  mysqli_fetch_row($rs);
    return $rs;
}

/**
 * mysqli_query 返回查询数组结果
 * @param object $conn 连接mysql对象变量
 * @param string $sql mysql查询字符串
 * @return 
*/
function mysqlSelect($conn,$sql)
{
    $rs = mysqli_query($conn,$sql);
    if($rs){
        mysqlLog($sql);
    }else{
        mysqlLog($sql.'\n'.mysqli_error($conn));
    }
    $data = [];
    while ($str = mysqli_fetch_assoc($rs))
    {
        $data[] = $str;
    }
    // $sql =  mysqli_fetch_row($rs);
    return $data;
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


?>