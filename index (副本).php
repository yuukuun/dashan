<?php 
session_start();	
/////////////////////////////////////////////////////// 引入 ///////////////////////////////////////////////////////
require_once "client/main.dilog.php";	//弹框文件
require_once "client/html.header.html";	//头部静态文件
require_once "mysql.php";	//数据库
?>

<style type="text/css">
	/*表格内对其*/
	.ali {	text-align: center;	}
</style>
<script type="text/javascript">
	///文章隐藏
	function hidden_js(id,pid){
		let pnum;
		//tprivate == 1公开文行
		if (pid === 1) {	pnum = 0;	}
		if (pid === 0) {	pnum = 1;	}
		//发送GET请求
		DILOG.gets('server/users.class.php?name=hidden&id=' + id + '&pid=' + pnum,reloadpage);	
		//刷新当前页
		// setTimeout(function(){ location.reload(); },1000);
		// location.reload();
	}
</script>


<?php
/////////////////////////////////////////////////////// 主类 ///////////////////////////////////////////////////////
class MainDisplay {
	private $arr;
	//导航栏
	public $navbar_index;
	public $navbar_admin;
	//后缀名区分
	public $videoext;
	public $audioext;


	function __construct()
	{	//主页导航
		$this->navbar_index = " <a onclick=\"ftexttit()\" class=\"nav-link\" href=\"#\" >文章</a> <a onclick=\"fmusic()\" class=\"nav-link\" href=\"#\" >音频</a><a onclick=\"fvideo()\" class=\"nav-link\" href=\"#\" >视频</a>";
		$this->navbar_admin = "<a class=\"nav-link\" href=\"".$_SERVER['PHP_SELF']."?s=txt\" >文章</a><a class=\"nav-link\" href=\"".$_SERVER['PHP_SELF']."?s=mus\" >音乐</a>";
		//后缀
		$this->audioext = array(".mp3",".wav",".flac",".m4a");
		$this->videoext = array(".mp4",".mkv");
	}

	/////导航栏显示
	// public function show_navbar($nav){
	public function show_navbar(){
		//处理
		$this->process_ttit("select distinct tgroup from t_txt");
		//
		echo "<header class=\"navbar navbar-expand navbar-dark fixed-top navbar-dark bg-dark\">";
		//未登陆状态下按钮
		if ( !isset($_SESSION['username']) && !isset($_SESSION['password']) ) {	
			echo "<a style=\"padding-right: 10px;\" class=\"mb-2\" href=\"client/sign.php\" target=\"_blank\">@</a>";
		//登陆状态下的按钮
		}else{	//登陆用户的显示导航按钮
			echo "<a style=\"padding-right: 10px;\" class=\"mb-2\" href=\"#\" id=\"bd-versions\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">@</a>";
			echo "<div class=\"dropdown-menu dropdown-menu-md-left\" aria-labelledby=\"bd-versions\">";
		 	echo "<a onclick=\"DILOG.instxt()\" class=\"dropdown-item\" href=\"#\"><div data-target=\"#write\" data-toggle=\"modal\" >写文章</div></a>";
		 	echo "<div class=\"dropdown-divider\"></div><a onclick=\"DILOG.note()\" class=\"dropdown-item\" href=\"#\"><div data-target=\"#write\" data-toggle=\"modal\" >记事本</div></a>";
		 	echo "<div class=\"dropdown-divider\"></div><a onclick=\"DILOG.ytb()\" class=\"dropdown-item\" href=\"#\"><div data-target=\"#write\" data-toggle=\"modal\" >YTB</div></a>";
		 	//echo "<div class=\"dropdown-divider\"></div><a  class=\"dropdown-item\" href=\"client/upload.form.php\" target=\"_blank\"><div >上传</div></a>";
		 	echo "<div class=\"dropdown-divider\"></div><a class=\"dropdown-item active\" href=\"".$_SERVER['PHP_SELF']."?s=txt\" target=\"_blank\">后台</a>";
		}
		echo "</div><div class=\"nav-scroller\"> <ul class=\"nav bd-navbar-nav flex-row\"> ";
		//echo " <a onclick=\"ftexttit()\" class=\"nav-link\" href=\"#\" >文章</a> <a onclick=\"fmusic()\" class=\"nav-link\" href=\"#\" >音频</a><a onclick=\"fvideo()\" class=\"nav-link\" href=\"#\" >视频</a>";
		// echo "<a onclick=\"ftexttit()\" class=\"nav-link\" href=\"#\" >文章</a> <a onclick=\"fmusic()\" class=\"nav-link\" href=\"#\" >音频</a><a onclick=\"fvideo()\" class=\"nav-link\" href=\"#\" >视频</a>";
		// $this->show_navs;
		// var_dump($this->arr);
	
		foreach ($this->arr as $value) {
			echo "<a onclick=\"txtgroup('".$value['tgroup']."')\" class=\"nav-link\">".$value['tgroup']."</a>";
		}
		echo "<a onclick=\"fmusic()\" class=\"nav-link\" href=\"#\" >音频</a><a onclick=\"fvideo()\" class=\"nav-link\" href=\"#\" >视频</a>";
		echo "</ul></div></header>";
		foreach ($this->arr as $value) {
			$this->show_ttit($value['tgroup']);
		}
	}
	// public function show_navs(){
	// 	return "<a onclick=\"ftexttit()\" class=\"nav-link\" href=\"#\" >文章</a> <a onclick=\"fmusic()\" class=\"nav-link\" href=\"#\" >音频</a><a onclick=\"fvideo()\" class=\"nav-link\" href=\"#\" >视频</a>";
	// 	// echo $nav;
	// }


	/////处理文本标题
	private function process_ttit($sql){
		//数据库调用
		$mysql = mysql_con();
		//访问mysql
		// $sql = "select tgroup,tid,ttit,tprivate from t_txt";  
		$res = $mysql->query($sql);	
		while($row = $res->fetch_assoc()){
			$this->arr[] = $row;
		}
	}	


	/////显示文本标题
	public function show_ttit($group){
		
		//处理
		$this->process_ttit("select tgroup,tid,ttit,tprivate from t_txt where tgroup = '$group'");
		// $this->process_ttit("select tgroup,tid,ttit,tprivate from t_txt");
		//
		echo "<span id=\"".$group."\"><div class=\"row\">";
		//遍历文章$i是行数
		for ($i=0; $i < count($this->arr); $i++) { 
			//
			//如果是登陆用户所有文章显示
			if ( isset($_SESSION['username']) && isset($_SESSION['password']) && $this->arr[$i]["tid"] != 1 ) {
				echo  "<a id=\"".$this->arr[$i]["tgroup"]."\" onclick=\"DILOG.showtxt(".$this->arr[$i]["tid"].")\" class=\"tit col-12 col-md-6\" href=\"#\"> <div data-target=\"#write\" data-toggle=\"modal\" >".$this->arr[$i]["ttit"]."</div> </a>";
			//如果是访客 公开的文章显示 t_txt表的tprivate字段 1是公开 0是隐藏
			}else{
				//个人记事本不限
				if ($this->arr[$i]["tid"] != "1" && $this->arr[$i]["tprivate"] == "1") {
					echo  "<a id=\"".$this->arr[$i]["tgroup"]."\" onclick=\"DILOG.showtxt(".$this->arr[$i]["tid"].")\" class=\"tit col-12 col-md-6\" href=\"#\" > <div data-target=\"#write\" data-toggle=\"modal\" >".$this->arr[$i]["ttit"]."</div></a>";
				}
			}
		}
		echo "</div></span>";
	}

	/////处理本地 music和 video
	public function show_media($dir){
		echo "<span id=\"".$dir."\"><div class=\"row\">";
		//
		foreach (glob($dir."/*") as $value) {
		if (is_dir($value)) {
			//目录名子标题
			$arr = explode('/', $value);
			$btit = end($arr);
			// echo $dir;
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div></div>";
			//如果$value是目录的化调用本身
			$this->show_media($value);
			// echo "<div class=\"row\">";
		//如果是文件
		}else{
			//获取后缀名
			$ext = strstr($value,'.');
			//判断是否lrc存在
			if ( file_exists(strstr($value,'.',true).".lrc") ) {  $lrc = "*";	}else{	$lrc = "";	}	

			//获取标题
			$arr = explode('/', $value);	//'/'分数组
			$tit = end($arr);				//数组最后一个元素
			$tit = strstr($tit,'.',true);	//'.'分割 
			//
			// echo "<div class=\"row\">";
			//$jsdelivr_url = "https://cdn.jsdelivr.net/gh/yuukuun/dashan@1.01/";
			//根据后缀是不是音乐文件
			if ( in_array($ext, $this->audioext) ) {
			// if ( $ext == ".flac" || $ext == ".mp3" || $ext == ".wav" || $ext == ".m4a" ) {
				//输出音频
				echo "<div class=\"tit col-12 col-md-4\"><a onclick=\"XPlAYER.audio('".$jsdelivr_url.$value."')\" href=\"#m\">".$lrc.$tit."</a><a style=\"color: #e8e7e3; float: top; float: right; \" download href=\"".$jsdelivr_url.$value."\">下载</a></div>";
			}elseif( in_array($ext, $this->videoext) ) {
				//输出视频
				echo "<div class=\"tit col-12 col-md-4\"><a onclick=\"XPlAYER.videos('".$jsdelivr_url.$value."')\" href=\"#m\">".$tit."</a><a  style=\"color: #e8e7e3; float: top; float: right;\" download href=\"".$jsdelivr_url.$value."\">下载</a></div>";
			}
		}
	}
	echo "</div></span>";	
	}// 函数结束

	public function show_media_admin($dir){
			echo "<div class=\"row\">";
		//
		foreach (glob($dir."/*") as $value) {
		if (is_dir($value)) {
			//目录名子标题
			$arr = explode('/', $value);
			$btit = end($arr);
			// echo $dir;
			echo "<div class=\"btit col-12 col-md-12\">".$btit."</div></div>";
			//如果$value是目录的化调用本身
			$this->show_media_admin($value);
			// echo "<div class=\"row\">";
		//如果是文件
		}else{
			//获取后缀名
			$ext = strstr($value,'.');
			//获取标题
			$arr = explode('/', $value);	//'/'分数组
			$tit = end($arr);				//数组最后一个元素
			$tit = strstr($tit,'.',true);	//'.'分割 
			//
			// echo "<div class=\"row\">";
			//$jsdelivr_url = "https://cdn.jsdelivr.net/gh/yuukuun/dashan@1.01/";
			//根据后缀是不是音乐文件
			if ( $ext == ".flac" ) {	$audiocol = "titflac";
				}elseif( $ext == ".wav" ){	$audiocol = "titwav";	
				}elseif( $ext == ".mp3" ){	$audiocol = "titmp3";	
			}
			
			// 输出音频
			echo "<div class=\"tit ".$audiocol." col-12 col-md-4\"><a onclick=\"XPlAYER.audio('".$jsdelivr_url.$value."')\" href=\"#m\">".$tit."</a><a style=\"color: #e8e7e3; float: top; float: right; \" download href=\"".$jsdelivr_url.$value."\">下载</a></div>";
		}
	}
	echo "</div>";
	}// 函数结束


	/////显示文本
	public function show_admin(){
		//处理
		$this->process_ttit("select tgroup,tid,ttit,tprivate from t_txt");
		//表头
		echo "<form id=\"adminform\"> <div class=\"table-responsive\"><table class=\"table table-bordered table-hover\"><tr><th class=\"ali\">ID</th><th>组</th><th>标题</th><th class=\"ali\">公开</th><th class=\"ali\">操作</th></tr>";
		//// $i是行数
		for ($i=0; $i < count($this->arr); $i++) { 
			//基础变量
				$id = $this->arr[$i]['tid'];
				$tit = mb_substr($this->arr[$i]['ttit'], 0, 12);
				// $cont = mb_substr($this->arr[$i]['tcont'], 0, 25);
				$group = $this->arr[$i]['tgroup'];		//文章隐藏
				$tp = $this->arr[$i]['tprivate'];		//文章隐藏

			//根据$tp变量的值来确定开关状态
			if ($tp == "1") {	$chk = "checked";	}else{	$chk = "";	}
			//按钮
			$btn = "<div onclick=\"hidden_js(".$id.",".$tp.")\" class=\"custom-control custom-switch\"><div><input type=\"checkbox\" ".$chk." class=\"custom-control-input\" name=\"".$id."\" id=\"".$id."\"><label class=\"custom-control-label\" for=\"".$id."\"></label></div></div>";

			//表格显示输出
			echo  "<tr><td class=\"ali\">".$id."</td><td class=\"ali\">".$group."</td><td>".$tit."</td><td class=\"ali\">".$btn."</td><td class=\"ali\"><a onclick=\"DILOG.showtxt(".$id.")\" href=\"#\"><div data-target=\"#write\" data-toggle=\"modal\" >查看</div></a></td></tr>";
		}
		//表尾
		echo "</table></div></form>";
	}




} //类结束
$diplay = new MainDisplay();


/////后台
// if ( $_GET['s'] == "admin" ) {
// echo "<main role=\"main\" class=\"container-fluid\">";	
// 	//判断是否登陆
// 	if ( isset($_SESSION['username']) && isset($_SESSION['password']) ) {
// 		$diplay->show_navbar($diplay->navbar_admin);	//导航栏
// 		$diplay->show_admin();	//文章	
// 		$diplay->show_media_admin("music");	//文章	
// 	}else{
// 		echo "请登录！";
// 	}
// echo "</main>";	

// /////前台
// }else{
// 	$diplay->show_navbar($diplay->navbar_index);	//导航栏
// echo "<main role=\"main\" class=\"container\">";
// 	$diplay->show_ttit();	//文章
// 	$diplay->show_media("music");	//音乐
// 	$diplay->show_media("video");	//音乐
// echo "</main>";	
// }




///首页显示///
if ( $_GET['s'] == "" ) {
echo "<main role=\"main\" class=\"container\">";
// $diplay->show_navbar($diplay->navbar_index);	//导航栏
$diplay->show_navbar();	//导航栏
	// $diplay->show_ttit("网络");	//文章
	// $diplay->show_ttit("默认");	//文章
	// $diplay->show_media("music");	//音乐
	// $diplay->show_media("video");	//音乐
echo "</main>";	
///后台显示///
}elseif($_GET['s'] != ""){
	// header("location: https://baidu.com"); 
	//判断是否登陆
	if ( isset($_SESSION['username']) && isset($_SESSION['password']) ) {
		echo "<main role=\"main\" class=\"container-fluid\">";	
			//导航栏
			$diplay->show_navbar();	
			//文本
			if ( $_GET['s'] == "txt" ) {	$diplay->show_admin();		}
			//音乐
			if ( $_GET['s'] == "mus" ) {	$diplay->show_media_admin("music");		}
		echo "</main>";	
	}else{
		// ob_start(); 
		echo "点击<a href=\"client/sign.php\">这里</a>登陆！";
		// header("location: https://baidu.com"); 
		// ob_end_flush();//输出全部内容到浏览器 
	}
}



///////////////////////////////////////////////////////引入 ///////////////////////////////////////////////////////
require_once "client/html.footer.html";	//尾静态文	
?>






