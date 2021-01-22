<?php
session_start();
//如果是登陆用户才显示
if ( isset($_SESSION['username']) && isset($_SESSION['password']) ) {
/////////////////////////////////////////////////////// 引入 ///////////////////////////////////////////////////////
require_once "client/main.dilog.php";	//弹框文件
require_once "client/html.header.html";	//头部静态文件
require_once "mysql.php";	//数据库

////// 定义类 //////
class Admin {
	private $json;
	//////	获取数据
	public function model(){
		$mysqlcon = mysql_con(); //链接数据库
		$sql = "select tid,ttit,tcont,tprivate from t_txt"; 
	    $res = $mysqlcon->query($sql);  
		    while($row = $res->fetch_assoc()){
		        $arr[] = $row;
		      }
	   return  $arr;
	}
	////// 显示
	public function display(){
		//获取数据
		$arr = $this->model();
		// var_dump($arr);
		//表头
		echo "<form id=\"adminform\"> <div class=\"table-responsive\"><table class=\"table table-bordered table-hover\">
		<tr><th style=\"text-align: center;\">ID</th><th >标题</th><th>内容</th><th style=\"text-align: center;\">公开</th><th style=\"text-align: center;\">操作</th></tr>";
		//循环输出文章 $i是行数
		for ($i=0; $i < count($arr); $i++) { 
			//文章公开按钮 的状态
			if ($arr[$i]['tprivate'] == "1") {
				$chk = "checked";
			}else{
				$chk = "";
			}
			//开关按钮
			$swit = "<div onclick=\"hiddens(".$arr[$i]['tid'].",".$arr[$i]['tprivate'].")\" class=\"custom-control custom-switch\"><div><input type=\"checkbox\" ".$chk." class=\"custom-control-input\" name=\"".$arr[$i]['tid']."\" id=\"".$arr[$i]['tid']."\"><label class=\"custom-control-label\" for=\"".$arr[$i]['tid']."\"></label></div></div>";
			if ($arr[$i]['tid'] == "1") {
				$swit = "";
			}
			//输出文章
			$tid = $arr[$i]['tid'];
			$ttit = mb_substr($arr[$i]['ttit'], 0, 12);
			$tcont = mb_substr($arr[$i]['tcont'], 0, 25);
			
			echo  "<tr><td style=\"text-align: center;\">".$tid."</td><td>".$ttit."</td><td>".$tcont."</td><th style=\"text-align: center;\" >".$swit."</th><td style=\"text-align: center;\"><a onclick=\"DILOG.showtxt(".$tid.")\" href=\"#\"><div data-target=\"#write\" data-toggle=\"modal\" >查看</div></a></td></tr>";
			
		}
		//表尾巴
		echo "</table></div></form>";
	}	
}



////// 判断是否登陆用户 //////
$nav=<<<EOF
     <div class="nav-scroller"><nav class="nav navbar-expand-lg fixed-top navbar-dark bg-dark py-2 mb-2">
    	<a  class="nav-link" href="index.php">主页</a>
    	<a onclick="DILOG.note()" class="nav-link" href="#" > <div data-target="#write" data-toggle="modal" >记事</div></a>
		<a onclick="DILOG.instxt()" class="nav-link" href="#" > <div data-target="#write" data-toggle="modal" >写文章</div></a>
		<a class="nav-link" href="#" >|</a>
		<a class="nav-link" href="#" >主页</a>
		<a class="nav-link" href="#" >主页</a>
		<a class="nav-link" href="#" >主页</a>
		<a class="nav-link" href="#" >主页</a>
 	</nav></div><hr>
EOF;
	echo "$nav";
	////// 对象 //////
	$admin = new Admin();
	$admin->display();		
	// echo $tt;
}else{
	echo "请登录";
}



///////////////////////////////////////////////////////引入 ///////////////////////////////////////////////////////
require_once "client/html.footer.html";	//尾静态文	
require_once "client/media.player.html";	// 媒体播放器
?>


<!------------------------------------------------- 文章公开功能的开关 ---------------------------------------------------->
<script type="text/javascript">
	//文章id和文章tprivate
	function hiddens(id,pid){
		let pnum;
		 	//tprivate == 1公开文行
			if (pid === 1) {
				pnum = 0;
			}
			//tprivate == 0非公开文行
			if (pid === 0) {
				pnum = 1;
			}
		//get请求
		DILOG.gets('server/users.class.php?name=hidden&id=' + id + '&pid=' + pnum,reloadpage);	
		//刷新当前页
		// setTimeout(function(){ location.reload(); },1000);
		// location.reload();
	}
	
</script>