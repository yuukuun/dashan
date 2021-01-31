// 主页的导航栏控制
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// 主页 /////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var INDEX = {};
//////初始化//////
INDEX.hidden_nav = function(){
    document.getElementById("video").style.display = "none";
    document.getElementById("music").style.display = "none";
    document.getElementById("默认").style.display = "none";
    document.getElementById("命运").style.display = "none";
    document.getElementById("网络").style.display = "none";
    document.getElementById("语言").style.display = "none";
}
//////显示视频//////
INDEX.fvideo = function(){
    INDEX.hidden_nav();
    document.getElementById("video").style.display = "block";
}
//////显示音乐//////
INDEX.fmusic = function(){
    INDEX.hidden_nav();
    document.getElementById("music").style.display = "block";
}
//////文章导航栏显示控制//////
INDEX.txtgroup = function(tgroup){
  INDEX.hidden_nav();
  let group = document.getElementById(tgroup);
   if ( group.style.display === "block" ) {
       group.style.display = "none";
   }else{
       group.style.display = "block"; 
   }
}