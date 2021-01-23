<?php

/////////////////////////////////////////////////////// 引入 ///////////////////////////////////////////////////////
require_once "client/main.dilog.php";	//弹框文件
require_once "client/html.header.html";	//头部静态文件
require_once "mysql.php";	//数据库
// echo md5("admin");
?>

<div class="container" action="t.php" >
	<form id="groupform" class="form-inline">
		<select class="form-control form-control-sm" name="sss" id="sss" >
		  <option  value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option selected value="4">4</option>
		</select>
		<input type="submit" >
	</form>
</div>

selected
<?php

// echo "qqqqqqqqqww<br>";

echo $_POST['sss'];
echo $_GET['sss'];



///////////////////////////////////////////////////////引入 ///////////////////////////////////////////////////////
require_once "client/html.footer.html";	//尾静态文	


?>

<select style=\"width: 65%;\" onclick="group_js(".$id.")" class="custom-select my-1 mr-sm-2" id="group" name="group"><option selected value="".$name."">".$name."</option>".$this->tgroup."</select>

