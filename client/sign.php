<?php
session_start();
require_once "../mysql.php";  //数据库
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>登陆</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">



    <form class="form-signin" method="post" id="userform">
	  <h4 class="h5 mb-3 font-weight-normal" style="color: red;">
      <?php 
    	 if (isset($_SESSION['mess'])) {
       	  echo $_SESSION['mess']; 
       }else{
          echo "请登陆！"; 
       }
      ?></h4>
	  <div class="form-group"><input type="text" id="username" name="username" class="form-control" placeholder="用户名" required autofocus></div>
	  <div class="form-group"><input type="password"  id="password" name="password" class="form-control" placeholder="密码" required></div>


	  <button onclick="USERS.submit()" class="btn btn-lg btn-primary btn-block" id="btnlogin">登陆</button>


	<!--   <p class="mt-5 mb-3 text-muted">&copy; 2021</p> -->
	</form>

</body>
</html>



<script type="text/javascript">
'use strict';
//获取对象
var USERS = {}; //USERS对象定义，防止重名
USERS.userform = document.getElementById("userform");   //form
USERS.username = document.getElementById("username");   //用户名
USERS.password = document.getElementById("password");   //密码

//按钮
USERS.btnlogin = document.getElementById("btnlogin");   //提交按钮
//用户名和密码的要求
//USERS.nums = /^\d{3}$/;  //定义密码和用户名要求


USERS.name = "login";
//登陆
USERS.submit = function() {
	//USERS.userform.action="../t.php?name=" + USERS.name;
	USERS.userform.action="../server/users.class.php?name=" + USERS.name;	
	USERS.userform.submit(); 
}




</script>

