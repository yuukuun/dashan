<?php
//显示错误
// error_reporting(E_ALL^E_NOTICE^E_WARNING);

//链接mysql函数
function mysql_con(){
    //链接数据
    $mysqlcon = new MySQLi('127.0.0.1','root','w123456','dashan_db'); 
    //编码设置
    // $mysqlcon->query("set names utf8");
    $mysqlcon->set_charset('utf8');
      //出错信息
      if($mysqlcon->connect_errno){
        die("MySQLi链接错误！".$mysqlcon->connect_error);
      //正确
      }else{
        //echo "<br>MySQLi链接成功！<br>";
      }
    return $mysqlcon;
}


// echo $_SERVER['PHP_SELF'];



?>