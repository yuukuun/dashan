<?php
session_start();
/////////////////////////////////////////////////////// 引入 ///////////////////////////////////////////////////////
require_once "client/main.dilog.php";	//弹框文件
require_once "client/html.header.html";	//头部静态文件
require_once "mysql.php";	//数据库
// echo md5("admin");
?>


<!----------------------------------------------- 导航部分 ----------------------------------------------------->


<!--   <div class="nav-scroller">
    <nav class="nav d-flex navbar-expand-lg fixed-top navbar-dark bg-dark "> -->

  <div class="nav-scroller">
    <nav class="nav navbar-expand-lg fixed-top navbar-dark bg-dark py-2 mb-2">

    	<!-- <li class="nav-item"><a class="p-2 text-muted" href="index.php?s=" >111</a></li> -->
<!--      	 <a class="nav-link" href="#">bbbb</a> -->
 

    <?php
    	//访客的导航按钮
		if ( !isset($_SESSION['username']) && !isset($_SESSION['password']) ) {
			echo "<a class=\"nav-link \" href=\"client/sign.php\" target=\"_blank\">&nbsp;登陆</a>";
		//登陆用户的显示导航按钮
		}else{
		 	echo "<a onclick=\"DILOG.getadmin()\" class=\"nav-link\" href=\"admin.php\" target=\"_blank\"><div>&nbsp;后台</div></a>";
		 	echo  "<a onclick=\"DILOG.note()\" class=\"nav-link\" href=\"#\" > <div data-target=\"#write\" data-toggle=\"modal\" >记事</div></a>";
		 	echo  "<a onclick=\"DILOG.instxt()\" class=\"nav-link\" href=\"#\" > <div data-target=\"#write\" data-toggle=\"modal\" >写文章</div></a>";
		}
	?>
	<a class="nav-link" href="#">|</a>
	<a onclick="ftexttit()" class="nav-link" href="#">文章</a>
    <a onclick="fmusictit()" class="nav-link" href="#">音频</a>
    <a onclick="fvideotit()" class="nav-link" href="#">视频</a>


    


 </nav></div><main role="main" class="container">



<?php

/////////////////////////////////////////////////////////////文章/////////////////////////////////////////////////////////////
/////获取文章/////
function texts(){
	//数据库调用
	$mysql = mysql_con();
	//访问mysql
	$sql = "select * from t_txt";  
	$res = $mysql->query($sql);	
	while($row = $res->fetch_assoc()){
		$arr[] = $row;
		}
	//遍历文章$i是行数
	for ($i=0; $i < count($arr); $i++) { 
		//如果是登陆用户所有文章显示
		if ( isset($_SESSION['username']) && isset($_SESSION['password']) && $arr[$i]["tid"] != 1 ) {
			echo  "<a onclick=\"DILOG.showtxt(".$arr[$i]["tid"].")\" class=\"tit col-12 col-md-6\" href=\"#\" > <div data-target=\"#write\" data-toggle=\"modal\" >".$arr[$i]["ttit"]."</div> </a>";
		//如果是访客 公开的文章显示 t_txt表的tprivate字段 1是公开 0是隐藏
		}else{
			if ($arr[$i]["tid"] != "1" && $arr[$i]["tprivate"] == "1") {
			echo  "<a onclick=\"DILOG.showtxt(".$arr[$i]["tid"].")\" class=\"tit col-12 col-md-6\" href=\"#\" > <div data-target=\"#write\" data-toggle=\"modal\" >".$arr[$i]["ttit"]."</div> </a>";
			}
		}
		
	}
}

/////////////////////////////////////////////////////////////视频和音乐/////////////////////////////////////////////////////////////
/////遍历video和music目录下所有文件包括子目录/////
function foreachs($dir){
	foreach (glob($dir."/*") as $value) {
		if (is_dir($value)) {
			//目录名子标题
			$arr = explode('/', $value);
			$btit = end($arr);
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div>";
			//如果$value是目录的化调用本身
			foreachs($value);
		//如果是文件
		}else{
			//获取后缀名
			$ext = strstr($value,'.');
			//获取标题
			$arr = explode('/', $value);	//'/'分数组
			$tit = end($arr);				//数组最后一个元素
			$tit = strstr($tit,'.',true);	//'.'分割
			$jsdelivr_url = "https://cdn.jsdelivr.net/gh/yuukuun/dashan@1.01/";
			//根据后缀是不是音乐文件
			if ( $ext == ".flac" || $ext == ".mp3" || $ext == ".wav" ) {
				//输出音频
				 // echo "<a href=\"#\" class=\"tit col-12 col-md-3\" ><div onclick=\"XPlAYER.audio('".$value."')\" >".$tit."</div></a>";
				//echo "<a href=\"#\" class=\"tit col-12 col-md-3\" ><div onclick=\"XPlAYER.audio('https://cdn.jsdelivr.net/gh/yuukuun/dashan@1.01/".$value."')\" >".$tit."</div></a>";
				echo "<a href=\"#\" class=\"tit col-12 col-md-3\" ><div onclick=\"XPlAYER.audio('".$jsdelivr_url.$value."')\" >".$tit."</div></a>";
		
			}else{
				//输出视频
				// echo "<a href=\"#\" class=\"tit col-12 col-md-3\" ><div onclick=\"XPlAYER.videos('".$value."')\" >".$tit."</div></a>";
				echo "<a href=\"#\" class=\"tit col-12 col-md-3\" ><div onclick=\"XPlAYER.videos('".$jsdelivr_url.$value."')\" >".$tit."</div></a>";
			}
		}
	}
}

/////////////////////////////////////////////////////////////文章 视频 音乐的显示与控制/////////////////////////////////////////////////////////////
/////输出文章/////
echo "<span id=\"texttit\"><div class=\"row\">";
	texts();
echo "</div></span>";

/////输出视频/////
echo "<span id=\"videotit\"><div class=\"row\">";
	foreachs("video");
echo "</div></span>";

/////输出音频/////
echo "<span id=\"musictit\"><div class=\"row\">";
	foreachs("music");
echo "</div></span>";






///////////////////////////////////////////////////////引入 ///////////////////////////////////////////////////////
require_once "client/html.footer.html";	//尾静态文	


?>



