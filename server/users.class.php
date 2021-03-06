<?php
session_start();

//引入公共字段和数据链接函数
require_once "../mysql.php";

//////////////////////////////////////////////////// 类 ////////////////////////////////////////////////////
class Users {
  private $arr; //临时数组
  private $title;   //文章标题
  private $texts;   //文章内容

  function __construct(){
    //mysql 链接
    $this->mysqlcon = mysql_con(); //链接数据库
  }


  //////// 登陆  ////////
  public function login($username,$password,$imgcode){
    $status = "";
    $username = $this->mysqlcon->real_escape_string($username);
    $password = $this->mysqlcon->real_escape_string($password);
      //条件查询时候用户名和密码是否存在
      $sql = "select uid from t_user where username='$username' and passwd='$password'"; 
      $res = $this->mysqlcon->query($sql);
      // $uid = $res->fetch_assoc();
      //如果登陆成功就用户名和密码保存在$_SESSION
      if ( $_SESSION['captch'] == $imgcode && $res->fetch_assoc() ) {
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



  //////// 插入初始化ok ////////
   public function ins_row(){
      $_SESSION['num'] = 0;
      $sql = "select * from t_txt where ttit='++标题++' and tcont='+++<pre><code>代码写这里</code></pre>+++' and uid='1'"; 
      $sres = $this->mysqlcon->query($sql);
      $arr = $sres->fetch_assoc();
      //如果文章不存在
      if ($arr == "") {
            $ins = "insert into t_txt set uid='1',ttit='++标题++',tcont='+++<pre><code>代码写这里</code></pre>+++'";
            // $insres = $this->mysqlcon->query($ins);
            if ($this->mysqlcon->query($ins)) {
                $inse = "初始化成功！";
                 $sres = $this->mysqlcon->query($sql);
                  $arr = $sres->fetch_assoc();
            }else{
                $inse = "初始化失败！";
            }
            $status = "不存在";
          }else{
            $status = "存在！";
          }

      // $arr["status"] = $status;
      // $arr["inse"] = $inse;
      echo json_encode($arr,JSON_UNESCAPED_UNICODE);
  }

  //////// 更新文章 文章写入//////// 
  public function update($tid,$ftitle,$ftexts){
      //特殊字符处理
      $title = $this->mysqlcon->real_escape_string($ftitle);
      $texts = $this->mysqlcon->real_escape_string($ftexts);
      //去掉空格
      $title = str_replace(' ', '',  $title);
      //标题和分组分开
      if ( strpos($title, '|') == true ) {
      	$arr = explode('|', $title);
      	$title = reset($arr);	//数组第一个元素
      	$tgroup = end($arr);	//数组最后一个元素
      }else{
      	$tgroup = '默认';
      }
      
        if ( $tid == 1 ) {
            $sql = "update t_txt set uid='1',tcont='$texts' where tid = '$tid'";
        }else{
            $sql = "update t_txt set uid='1',ttit='$title',tgroup='$tgroup',tcont='$texts' where tid = '$tid'";
        }
          $res = $this->mysqlcon->query($sql); 
            if ($res === TRUE) {
              $_SESSION['num'] = $_SESSION['num'] + 1;
              $status = $_SESSION['num']." 次保存文章成功！";
            }else{
              $status = "保存文章出错！";
            }
        // $arr["status"] = $status; //JSON_UNESCAPED_UNICODE - 酷极和 - 博客园
        // echo json_encode($arr, JSON_UNESCAPED_UNICODE);
        // echo $status;
        echo json_encode($status, JSON_UNESCAPED_UNICODE);
  }


  //////// 删除文章 ok////////
  public function delete($tid){
      $sql = "delete from t_txt where tid='$tid'"; 
       // echo $tids;
        //执行插入
      $boo = $this->mysqlcon->query($sql);  
          //判断成功
          if ($boo) {
            $status = "文章删除成功！";
            
          }else{
            $status = "文章删除出错！";
          }
      echo json_encode($status, JSON_UNESCAPED_UNICODE);
  }

    //////// 隐藏文章 ok////////
  public function hidden($tid,$pid){
       $sql = "update t_txt set tprivate='$pid' where tid = '$tid'";
          $res = $this->mysqlcon->query($sql); 
            if ($res === TRUE && $pid == 0 || $pid == 1) {
              // $status = "隐藏操作成功！";
                if ($pid == 1) {
                   $status = "文章公开成功！";
                }
                if ($pid == 0) {
                   $status = "文章隐藏成功！";
                }
            }else{
              $status = "隐藏出错！";
            }
        //echo $status;
       echo json_encode($status, JSON_UNESCAPED_UNICODE);
  }

    //////// 分组 ////////
  public function group($id,$group){

      $group = $this->mysqlcon->real_escape_string($_GET["group"]);
      // $id = $_GET["id"];
      $sql = "update t_txt set uid='1',tgroup='$group' where tid = '$id'";
       $res = $this->mysqlcon->query($sql); 
            if ($res === TRUE) {
              $status = $_SESSION['num']." 组成功！";
            }else{
              $status = "组出错！！！";
            }

      echo json_encode($status, JSON_UNESCAPED_UNICODE);
    }

   //////// 分组 ////////
  public function ytb(){
    $id = $_POST["texts"];

    $url = system("
#proxy='--proxy socks5://127.0.0.1:1080' >>/dev/null -g 
#>>/dev/null
num=\$(/usr/local/bin/youtube-dl -F \$proxy $id | grep 'audio' | head -n 1 | awk '{print \$1}') 
/usr/local/bin/youtube-dl -f \$num \$proxy $id  -o ../music/ytb/$(date +%y%m%d%H%M).m4a 
");
      echo json_encode($url, JSON_UNESCAPED_UNICODE);
    }



}

//////////////////////////////////////////////////// 对象和判断 ////////////////////////////////////////////////////
//创建对象
$users =  new Users();  
//打开缓冲区
ob_start(); 



//////// 登陆 ////////
if( $_GET["name"] == "login" && isset($_POST["username"]) && isset($_POST["password"]) ){
   //判断是否验证成功
    $_POST["password"] = md5($_POST["password"]);

   if ($users->login( $_POST["username"] , $_POST["password"] , $_POST["imgcode"] )) {
      //登陆成功跳转主页
      header("location: ../index.php");
   }


//////// 更新文章 ////////      
  }elseif( $_GET["name"] == "update" && is_numeric($_GET["id"])  ){   
    if ( $users->login($_SESSION['username'] , $_SESSION['password'] , $_SESSION['captch']) ) {
     $users->update($_GET["id"], $_POST["title"], $_POST["texts"]); 
   }

//////// 写入文章 更新 记事本////////   
}elseif( isset($_GET["name"]) && $_GET["name"] == "insert"  ){
    if ( $users->login($_SESSION['username'] , $_SESSION['password'] , $_SESSION['captch']) ) {
     $users->ins_row(); 
   }



//////// 删除 ok////////   
}elseif( $_GET["name"] == "delete" && is_numeric($_GET["id"])  ){  
    if ( $users->login($_SESSION['username'] , $_SESSION['password'] , $_SESSION['captch']) ) {
     $users->delete(($_GET["id"])); 
   }   

//////// 隐藏 ok////////   
}elseif( $_GET["name"] == "hidden" && is_numeric($_GET["id"])  && is_numeric($_GET["pid"]) ){
    if ( $users->login($_SESSION['username'] , $_SESSION['password'] , $_SESSION['captch']) ) {
     $users->hidden($_GET["id"],$_GET["pid"]); 
   }   

//////// 分组 ////////   
}elseif( $_GET["name"] == "group" ){
    if ( $users->login($_SESSION['username'] , $_SESSION['password'] , $_SESSION['captch']) ) {
     $users->group( $_GET["id"] , $_GET["group"] ); 
   }   

//////// 分组 ////////   
}elseif( $_GET["name"] == "ytb" ){
    if ( $users->login($_SESSION['username'] , $_SESSION['password'] , $_SESSION['captch']) ) {
     $users->ytb(); 
   }  

//////// 出错！ ////////
}else{
    echo json_encode("验证出错",JSON_UNESCAPED_UNICODE);
}

?>

