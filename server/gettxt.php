<?php
session_start();

//数据库
require_once "../mysql.php";

class TxtPage {
  public function select_row($tid){
      //mysql 链接
      $this->mysqlcon = mysql_con();
      //查询数据库
       $sql = "select tid,tgroup,ttit,tcont from t_txt where tid = '$tid'";  
   //  $sql = "select t_txt.tid,t_txt.tgroup,t_txt.ttit,t_txt.tcont,t_mes.mtext from t_txt,t_mes where t_txt.tid = '$tid' and t_mes.tid = '$tid'";  

      $res = $this->mysqlcon->query($sql);  
        while($row = $res->fetch_assoc()){
          $arr = $row;
        }
      if ( $arr["tid"] ) {
          $queryarr = $arr;
      }else{
          $queryarr = "没有此文章";
      }
      // $_SESSION['num'] 初始化
      $_SESSION['num'] = 0;

//////////////////
       $sqls = "select mtext from t_mes where tid='$tid'";  
    $ress = $this->mysqlcon->query($sqls);  
        while($row = $ress->fetch_assoc()){
          $arrs[] = $row;
        }
    $queryarr['mess'] = $arrs;
    return json_encode($queryarr, JSON_UNESCAPED_UNICODE);
  }
  

}
$txtPage =  new TxtPage();  //创建对象


//////// 如果id是数字就查询 ////////
if (is_numeric($_GET["id"])) {
    echo $txtPage->select_row($_GET["id"]);
//////// 用户 ////////
}else{
    echo "读取文章页出错！";
}


?>

