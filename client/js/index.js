// 'use strict';


//显示文章
 function ftexttit(){
    document.getElementById("texttit").style.display = "block";
    document.getElementById("videotit").style.display = "none";
    document.getElementById("musictit").style.display = "none";
}
//显示视频
function fvideotit(){
    document.getElementById("texttit").style.display = "none";
    document.getElementById("videotit").style.display = "block";
    document.getElementById("musictit").style.display = "none";
}
//显示音乐
function fmusictit(){
    document.getElementById("texttit").style.display = "none";
    document.getElementById("videotit").style.display = "none";
    document.getElementById("musictit").style.display = "block";
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// 弹框 /////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var DILOG = {};

//iframe 表单 2个输入框
DILOG.readiframe = document.getElementById("readiframe");   //弹框内框架
DILOG.tempifra = document.getElementById("temp");           //临时框架
//输入框
DILOG.formtxt = document.getElementById("formtxt"); //表单
DILOG.ids = document.getElementById("ids");     //input id 文章id
DILOG.title = document.getElementById("title");  //input title  文章标题
DILOG.texts = document.getElementById("texts"); //input texts 文章内容
//按钮
//DILOG.btnbc = document.getElementById("btnbc"); //保存按钮
DILOG.btnxg = document.getElementById("btnxg"); //修改按钮
DILOG.btnyl = document.getElementById("btnyl"); //预览按钮
DILOG.btnbj = document.getElementById("btnbj"); //编辑按钮


////// html静态文件头 //////
//DILOG.htmkhead = '<!doctype html><html lang="en"><head><meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><link rel="stylesheet" href="./client/css/bootstrap.min.css"><link rel="stylesheet" href="./client/css/index.css"><script src="client/js/index.js" type="text/javascript"><\/script><\/style><\/head><body><main role="main"><span class="contents">';
DILOG.htmkhead = '<!doctype html><html lang="en"><head><meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><link rel="stylesheet" href="client/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"><link rel="stylesheet" href="client/css/index.css"></head><body class="bg-light"><main role="main"><span class="contents">';
////// html静态文件尾巴 //////
//DILOG.htmkfoot = '</span></main></body></html><script src="./client/js/jquery.min.js" type="text/javascript">';
DILOG.htmkfoot = '</span></main></body></html><script src="client/js/jquery.min.js"></script><script src="client/js/code.js"></script><script src="client/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>';
// DILOG.js = '';

//////发送 get请获取 json字符串//////
DILOG.gets = function(url,huidiao) {
    //发送get请求
   let httpRequest = new XMLHttpRequest();//第一步：建立所需的对象
        httpRequest.open('GET', url, true);//第二步：打开连接  将请求参数写在url中  ps:"./Ptest.php?name=test&nameone=testone"
        httpRequest.send();//第三步：发送请求  将请求参数写在URL中
        /**
         * 获取数据后的处理程序
         */
        httpRequest.onreadystatechange = function () {
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                let json = httpRequest.responseText;//获取到json字符串，还需解析
                // let textnew = JSON.stringify(text);
                console.log(json);
                //转换为js
                json = JSON.parse(json);
                
               //回调函数
               huidiao(json);
	               if (json.tid != "") {
	               		 DILOG.ids.value = json.tid; 
	               }
	               if (json.ttit != "") {
	               		 DILOG.title.value = json.ttit; 
	               }
	               if (json.tcont != "") {
	               		 DILOG.texts.value = json.tcont; 
	               }

            }
        }
}



///////页面格式化至id=readiframe iframe//////
DILOG.page = function(json) {

    //替换特殊字符
    String.prototype.replaceAll = function (FindText, RepText) {
      return this.replace(new RegExp(FindText, "g"), RepText);
    }
    //用法，把所有<和>替换
    json.tcont = json.tcont.replaceAll("<","&lt;");
    json.tcont = json.tcont.replaceAll(">","&gt;");
    json.tcont = json.tcont.replaceAll("&lt;pre&gt;&lt;code&gt;","<pre><code>");
    json.tcont = json.tcont.replaceAll("&lt;/code&gt;&lt;/pre&gt;","</code></pre>");

    // 发送html文件到readiframe 样式文件在 index.css 和 index.js 内
    DILOG.readiframe.contentWindow.document.body.innerHTML = DILOG.htmkhead + json.ttit + '<hr>' + json.tcont + DILOG.htmkfoot;      
    // DILOG.readiframe.contentWindow.document.body.innerHTML = DILOG.js;      
}



//////记事本//////
DILOG.note = function() {
  DILOG.tempifra.contentWindow.document.body.innerText = ""; 
  //获取
  DILOG.gets('server/gettxt.php?id=1', DILOG.page);

  DILOG.ids.value = 1;
  //关闭输入框
  DILOG.readiframe.style = "display:none";
  DILOG.formtxt.style = "display:block";


  //按钮打开
  DILOG.btnyl.style.display = "block"; 
  DILOG.btnbj.style.display = "block"; 
  DILOG.btnxg.style.display = "block"; 
  //按钮关闭
  //DILOG.btnbc.style.display = "none"; 
  // DILOG.btnht.style.display = "none";    
}

//////写文章//////
DILOG.instxt = function() {
   DILOG.tempifra.contentWindow.document.body.innerText = ""; 
    //关闭输入框
    DILOG.formtxt.style = "display:block;";
    DILOG.readiframe.style = "display:none;";
    //按钮打开
    DILOG.btnyl.style.display = "block"; 
    DILOG.btnbj.style.display = "block"; 
    DILOG.btnxg.style.display = "block"; 
    //按钮关闭
    //DILOG.btnbc.style.display = "none"; 
    // DILOG.btnht.style.display = "none"; 
    //
    DILOG.title.style.display = "block";
    //初始化
    DILOG.title.value = "";
    DILOG.texts.value = "";
    DILOG.ids.value = "";
    DILOG.gets('server/users.class.php?name=insert', DILOG.instxtpre);
}
//初始化输入框
DILOG.instxtpre = function(json) {
  // let json = JSON.parse(jsonstr);
    DILOG.ids.value = json.tid;
    DILOG.title.value = json.ttit;
    DILOG.texts.value = json.tcont;
}


//////获取文章 并且显示//////
DILOG.showtxt = function(id) {
  //发送函数到
  DILOG.gets('server/gettxt.php?id=' + id, DILOG.page);
  DILOG.tempifra.contentWindow.document.body.innerText = ""; 

  DILOG.ids.value = id;
  //关闭输入框
  DILOG.formtxt.style = "display:none;";
  DILOG.readiframe.style = "display:block;";

  //按钮打开
  DILOG.btnyl.style.display = "block"; 
  DILOG.btnbj.style.display = "block"; 
  DILOG.btnxg.style.display = "block"; 
  //按钮关闭
  //DILOG.btnbc.style.display = "none";   
}

//////编辑//////
DILOG.edittxt = function() {
  //
  DILOG.title.setAttribute("class", "form-control"); //默认颜色
  DILOG.texts.setAttribute("class", "form-control"); ///默认颜色
  //编辑器
  DILOG.formtxt.style = "display:block;";
  DILOG.readiframe.style = "display:none;";
  //按钮打开
  DILOG.btnyl.style.display = "block"; 
  DILOG.btnbj.style.display = "block"; 
  DILOG.btnxg.style.display = "block"; 
  //按钮关闭
  //DILOG.btnbc.style.display = "none"; 
}

//////预览//////
DILOG.preview = function() {
    //编辑器
  DILOG.formtxt.style = "display:none;";
  DILOG.readiframe.style = "display:block;";
  //按钮打开
  DILOG.btnyl.style.display = "block"; 
  DILOG.btnbj.style.display = "block"; 
  DILOG.btnxg.style.display = "block"; 
  //按钮关闭
  //DILOG.btnbc.style.display = "none"; 
  //json字符串 调用DILOG.page()函数 
  //let str = '{tid: "578", ttit: "++标题++wqewqe", tcont: "++代码语言写在<pre><code>my code</code></pre>标签内++"}'; /js的
  //let str = '{tid: "", ttit: "'+ DILOG.title.value  +'", tcont: "'+ DILOG.texts.value +'"}';
  DILOG.page({tid: "", ttit: DILOG.title.value, tcont: DILOG.texts.value});

console.log( DILOG.ids.value ); 
}


//////删除文章//////
DILOG.delete = function(){
  //按钮
  DILOG.btnxg.style.display = "none"; 
  DILOG.btnyl.style.display = "none"; 
  DILOG.btnbj.style.display = "none"; 
  //get请求
  DILOG.gets("server/users.class.php?name=delete&id=" + DILOG.ids.value,reloadpage);
  //刷新页面
  // setTimeout(function(){ location.reload(); },1000);
}

//////验证输入框是否空//////
DILOG.yanzheng = function(){
          //验证 标题是否空
          if (DILOG.title.value === "") {
              DILOG.title.setAttribute("class", "form-control is-invalid");//红色
          }else{
              DILOG.title.setAttribute("class", "form-control is-valid"); //绿色
          }    
            //验证 文章是否空
            if (DILOG.texts.value === "") {
                DILOG.texts.setAttribute("class", "form-control is-invalid"); //红色
            }else{
                DILOG.texts.setAttribute("class", "form-control is-valid"); //绿色
            }      
        //标题或内容不空的化提交表单
        if (DILOG.texts.value != "" && DILOG.title.value != "") {
              DILOG.title.setAttribute("class", "form-control is-valid"); //标题框显示绿色
              DILOG.texts.setAttribute("class", "form-control is-valid"); //文章框显示蓝色
                //DILOG.btnxg.setAttribute("data-dismiss", "modal"); //data-dismiss="modal" 关闭按钮
                //DILOG.btntj.setAttribute("data-dismiss", "modal"); //data-dismiss="modal" 关闭按钮
              DILOG.formtxt.submit(); 
        }  
  }

//////提交文章//////
DILOG.modfisubmit = function(){
    formtxt.action = "server/users.class.php?name=update&id=" + DILOG.ids.value;  //action修改
   // formtxt.action = "server/users.class.php?&tid=" + DILOG.ids.value;  //action修改
    DILOG.formtxt.target = "temp";  //action修改
    DILOG.yanzheng();
}
// DILOG.modfisubmit = function(){
//     formtxt.action = "server/users.class.php?tid=" + DILOG.ids.value;  //action修改
//     DILOG.formtxt.target = "temp";  //action修改
//     DILOG.yanzheng();
// }

//刷新页面
// function reloadpage(){
reloadpage = function(){
  location.reload();
} 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// 视频 /////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var XPlAYER = {};

//视频播放
// function videos(vid) {
XPlAYER.videos = function(vid) {
  //播放器
  document.getElementById("videoplayerid").src = vid; 

  //关闭音乐
  document.getElementById("aplayer").style.display = "none"; 
  const ap = new APlayer({
    container: document.getElementById('aplayer'),
    autoplay: true, //自动播放
    audio: {
        name: "",
        url: "",
      }
  });

  //显示视频播放器
  document.getElementById("newmove").style.display = "block"; 
  document.getElementById("videoplayerid").style.display = "block"; 

  //播放拖动调用
  bindEvent('newmove');
}

//视频停止按钮
function vidstops(){
    document.getElementById("newmove").style.display = "none"; 
    document.getElementById("videoplayerid").src = "";   //audio元素的src修改
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// 音频 /////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
XPlAYER.audio = function(path) {
  //关闭视频
  document.getElementById("newmove").style.display = "none"; 
  document.getElementById("videoplayerid").style.display = "none"; 
  document.getElementById("videoplayerid").src = "";   //audio元素的src修改
  //显示播放
   document.getElementById("aplayer").style.display = "block"; 
  //音乐
  const ap = new APlayer({
    container: document.getElementById('aplayer'),
    fixed: true,
    mutex: true, //防止重复播放
    autoplay: true, //自动播放
    loop: 'all',  //循环
    audio: {
        name: path,
        url: path,
      }
  });
  bindEvent('aplayer');
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////口拖动 ///////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//封装了一个取消默认事件的函数，用来兼容老IE
function cancelHandler(event){
    if (event.preventDefault) {
      event.preventDefault();
    } else {
      event.returnValue = false;
    }
  } 
//拖动主要函数  
function bindEvent(_id) {
  var ele = document.getElementById(_id);
    //设置鼠标落下时的x、y坐标为X和Y,盒子的left和top值存为boxL和boxT,鼠标落下时的点距离盒子左边和上边的距离存为disL和disT
    let X, L, boxL, boxT, disL, disT, drag = false;
    ele.onmousedown = function(e) {
        drag = true;
        var e = e || window.event; //兼容ie
        X = e.clientX;
        Y = e.clientY;
        boxL = ele.offsetLeft;
        boxT = ele.offsetTop;
        disL = X - boxL;
        disT = Y - boxT;
        cancelHandler(e);
    }
    document.onmousemove = function(e) {
        var e = e || window.event;
        if (drag) {
            ele.style.left = e.clientX - disL + 'px';
            ele.style.top = e.clientY - disT + 'px';
        }
    }
    ele.onmouseup = function() {
        drag = false;
    }
} 