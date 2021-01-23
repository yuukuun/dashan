<?php
session_start();
///////////////////////////////////////////////////////// 如果是登陆用户才显示 ///////////////////////////////////////////////////////
if ( isset($_SESSION['username']) && isset($_SESSION['password']) ) {
/////////////////////////////////////////////////////// 引入 ///////////////////////////////////////////////////////
require_once "client/main.dilog.php";	//弹框文件
require_once "client/html.header.html";	//头部静态文件
require_once "mysql.php";	//数据库



////// 定义类 //////
class Admin {
	// private $json;
	private $tgroup;

	//////	获取文章的原始数组 //////
	private function getarr($sql){
		//链接数据库
		$mysqlcon = mysql_con(); 
		//循环保存到数组
	    $res = $mysqlcon->query($sql);  
		    while($row = $res->fetch_assoc()){
		        $arr[] = $row;      
		      }
	   //返回数组
	   return  $arr;
	}

	////// 显示 //////
	public function display(){
		////初始化
		$name = $_GET['name'];	
		if ($_GET['name'] == "") {
			$name = "默认";
		}
		//获取多个字段
		$arr = $this->getarr("select tid,tgroup,ttit,tcont,tprivate from t_txt where tgroup='$name'");	
		//获取文章的组
		$tgroup = $this->getarr("select distinct tgroup from t_txt order by tgroup desc");	
		// $tgroup = $this->getarr("select tid,distinct tgroup from t_txt order by tid");	
		
////// 导航栏 //////
$navs=<<<EOF
<div class="nav-scroller"><nav class="nav navbar-expand-lg fixed-top navbar-dark bg-dark py-2 mb-2">
<a class="nav-link" href="index.php">主页</a>
<a onclick="DILOG.note()" class="nav-link" href="#" ><div data-target="#write" data-toggle="modal" >记事本</div></a>
<a onclick="DILOG.instxt()" class="nav-link" href="#" ><div data-target="#write" data-toggle="modal" >写文章</div></a>
<a class="nav-link" href="#">|</a>
EOF;
echo $navs; 
		for ($i=0; $i < count($tgroup); $i++) { 
			//文章组输出到导航栏
			echo "<a class=\"nav-link\" href=\"admin.php?name=".$tgroup[$i]['tgroup']."\">".$tgroup[$i]['tgroup']."</a>"; 
			if ($tgroup[$i]['tgroup'] != $name) {
				//文章组的字段保存变量
				$this->tgroup = $this->tgroup."<option value=\"".$tgroup[$i]['tgroup']."\">".$tgroup[$i]['tgroup']."</option>";
			}	
		}		
		echo "</nav></div><hr>"; 	


////// 表格 //////
echo "<form id=\"adminform\"> <div class=\"table-responsive\"><table class=\"table table-bordered table-hover\"><tr><th class=\"ali\">ID</th><th>标题</th><th>内容</th><th class=\"ali\">公开</th><th class=\"ali\">操作</th></tr>";
		//// $i是行数
		for ($i=0; $i < count($arr); $i++) { 
			//基础变量
				$id = $arr[$i]['tid'];
				$tit = mb_substr($arr[$i]['ttit'], 0, 12);
				$cont = mb_substr($arr[$i]['tcont'], 0, 25);
				$group = $arr[$i]['tgroup'];		//文章隐藏
				$tp = $arr[$i]['tprivate'];		//文章隐藏

			//文章分组
		//$grouphtml = "<form class=\"form-inline\" id=\"formselect\"><select style=\"width: 85%;\" onclick=\"group_js(".$id.")\" class=\"custom-select my-1 mr-sm-2\" id=\"group\" name=\"group\"><option selected value=\"".$name."\">".$name."</option>".$this->tgroup."</select></form>";

			//根据$tp变量的值来确定开关状态
			if ($tp == "1") {	$chk = "checked";	}else{	$chk = "";	}
			//按钮
			$btn = "<div onclick=\"hidden_js(".$id.",".$tp.")\" class=\"custom-control custom-switch\"><div><input type=\"checkbox\" ".$chk." class=\"custom-control-input\" name=\"".$id."\" id=\"".$id."\"><label class=\"custom-control-label\" for=\"".$id."\"></label></div></div>";

			//表格显示输出
			echo  "<tr><td class=\"ali\">".$id."</td><td>".$tit."</td><td>".$cont."</td><td class=\"ali\">".$btn."</td><td class=\"ali\"><a onclick=\"DILOG.showtxt(".$id.")\" href=\"#\"><div data-target=\"#write\" data-toggle=\"modal\" >查看</div></a></td></tr>";
		}

		//表尾巴
		echo "</table></div></form>";
		//echo $_GET['group']."```````````````";
	}	
}
////// 对象 //////
$admin = new Admin();
$admin->display();		
/////////////////////////////////////////////////////// 无权限 ///////////////////////////////////////////////////////
}else{
	echo "请登录";
}



///////////////////////////////////////////////////////引入 ///////////////////////////////////////////////////////
require_once "client/html.footer.html";	//尾静态文	
require_once "client/media.player.html";	// 媒体播放器
?>


<!------------------------------------------------- 文章公开功能的开关 ---------------------------------------------------->


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

	///改变文章组
	function group_js_t(id){
		//获取select的id
		let group = document.getElementById('group');
		//获取option的value值
		// let val = group.options[group.selectedIndex].value;
		let val = group.options[group.selectedIndex].value;
	    DILOG.gets('server/users.class.php?name=group&id=' + id + '&group=' + val,nulls);
	}
	function group_js(id){
		formselect = document.getElementById("formselect"); //编辑按钮
		// formselect.target = "#";  //action修改
	    //formselect.action = "server/users.class.php?name=update&id=";  //action修改
	    formselect.action = "#";  //action修改
	    formselect.submit(); 
	    // group.options[group.selectedIndex].value = "";
	    location.reload();
	}
	///空函数
	function nulls(){}
	document.getElementById('group').options[group.selectedIndex].value = "";
</script>