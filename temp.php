<?php

// echo strstr('FILE.MP3','.');	//获取.MP3 
// echo strstr('FILE.MP3','.',true);	//获取FILE

// echo var_dump(glob("/*"));
// echo is_dir("/boot");

//字符串
// echo str_replace('W','*',"Hello Word!"); 

// $arr = array('哈哈' , '卡卡');
// //json
// echo json_encode($arr,JSON_UNESCAPED_UNICODE);	//json编码中文不乱码
// json_decode();	//解码json

//返回字符串中出现的位置，没有就返回false
// echo strpos("Hello Word","X");	

//文件是否存在就返回1
// echo file_exists("/boot");
// //转为数字
// echo number_format("23");

//生成五位随机数字
echo mt_rand(10000,90000);
var_dump(strval("12312"))

?>