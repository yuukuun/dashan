<?php
session_start();

//引入公共字段和数据链接函数
require_once "../mysql.php";

//////////////////////////////////////////////////// 信息类 ////////////////////////////////////////////////////
class Mess {
  function __construct(){
    //mysql 链接
    $this->mysqlcon = mysql_con(); //链接数据库
  }
  public function login($username,$password){
    $status = "";
    $username = $this->mysqlcon->real_escape_string($username);
    $password = $this->mysqlcon->real_escape_string($password);
      //条件查询时候用户名和密码是否存在
      $sql = "select uid from t_user where username='$username' and passwd='$password'"; 
      $res = $this->mysqlcon->query($sql);
      // $uid = $res->fetch_assoc();
      //如果登陆成功就用户名和密码保存在$_SESSION
      if ( $res->fetch_assoc() ) {
          $_SESSION['username'] = $username;
          $_SESSION['password'] = $password;
          $status = 1;
      //如果失败跳转登陆界面 提示
      }else{
          $_SESSION['mess'] = "登陆出错！";
          //跳转
          header("location: ../client/sign.php"); 
      }
    //返回bool
      // var_dump($uid);
    return $status;
  }

  // private function mess_query(){
  //   $sql = "select mid,mtext from t_mes";  
  //   $res = $this->mysqlcon->query($sql);  
  //       while($row = $res->fetch_assoc()){
  //         $arr[] = $row;
  //       }
  //   return $arr;
  // }



  public function mess_insert($mess,$tid){
    // $sql = "insert into t_mes set mtext='$mess'";
    $sql = "insert into t_mes set mtext='$mess',tid='$tid'";
    if ($this->mysqlcon->query($sql)) {
        $status = "留言写入成功！";
    }else{
        $status = "留言写入失败！";
          }
    echo json_encode($status, JSON_UNESCAPED_UNICODE);
  }

  // public function json(){
  //   return json_encode($this->mess_query(), JSON_UNESCAPED_UNICODE);
  // }
}
$mess = new Mess();

// echo $_POST['mestexts']."<br>";
echo $_POST['mestid']."<br>";


// if ( $_POST['mestexts'] != "" && $_POST['mestids'] != "" ) {
if ( $_POST['mestexts'] != "" ) {
    if ( $mess->login($_SESSION["username"] , $_SESSION["password"] ) ) {
        $mess->mess_insert( $_POST['mestexts'] , $_POST['mestid']);
   }
// }elseif  ( $_POST['tid'] != "" ) {   
//     $mess->get_mess( $_POST['tid'] );
}else{
  echo "mess出错";
}














?>