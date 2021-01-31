// 控制dilog内元素的外尺寸
///////////////////////////////////////////////////////// 替换特殊字符 /////////////////////////////////////////////////////////
String.prototype.replaceAll = function (FindText, RepText) {
    return this.replace(new RegExp(FindText, "g"), RepText);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// 发送get请求 /////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var GET = {};
GET.josn = "";

// 新建XMLHttpRequest对象
GET.request = new XMLHttpRequest(); 
//发送get
GET.get = function(urls,huidiao){
  if (urls != "") {
    // 发送请求:
    GET.request.open('GET', urls);
    GET.request.send();  
      GET.request.onreadystatechange = function () { // 状态发生变化时，函数被回调
        if (GET.request.readyState === 4) { // 成功完成
            // 判断响应结果:
            if (GET.request.status === 200) {
                // 成功，通过responseText拿到响应的文本:
                // return GET.success(GET.request.responseText);
                //json格式化
                json = JSON.parse(GET.request.responseText);
                    //初始化辩机框
                    if (json.tid != "") {
                         DILOG.ids.value = json.tid; 
                     }
                     if (json.ttit != "") {
                         DILOG.title.value = json.ttit + '|' + json.tgroup; 
                     }
                     if (json.tcont != "") {
                         DILOG.texts.value = json.tcont; 
                     }
                     console.log(json);
                return huidiao(json); //转换为json格式
            } else {
                // 失败，根据响应码判断失败原因:
                // return GET.fail(GET.request.status);
                return huidiao(GET.request.status);
            }
        } else {
            // HTTP请求还在继续...
        }
    }
  }
}
//空函数
GET.null = function() {}
//被回调的函数
// GET.suc = function(json) {
//     console.log(json);
// }
//调用获取数据函数
// GET.get("server/mess.php",GET.suc);


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// dilog定义 /////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var DILOG = {};

//////readiframe高度 和 texts高度控制函数//////
DILOG.readiframe = document.getElementById("readiframe");   //读文章框架
DILOG.tempifra = document.getElementById("temp");           //提交状态信息显示
//输入框
DILOG.formtxt = document.getElementById("formtxt"); //表单
DILOG.ids = document.getElementById("ids");     //input id 文章id
DILOG.title = document.getElementById("title");  //input title  标题
DILOG.texts = document.getElementById("texts"); //input texts 内容
//按钮
DILOG.btnxg = document.getElementById("btnxg"); //修改按钮
DILOG.btnyl = document.getElementById("btnyl"); //预览按钮
DILOG.btnbj = document.getElementById("btnbj"); //编辑按钮


///////////////////////////////////////////////////////// readiframe框架内元素 /////////////////////////////////////////////////////////
var IFR = {};
//html头
IFR.htmlhead = `<!doctype html><html lang="en"><head><meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><link rel="stylesheet" href="client/css/bootstrap.min.css">
<link rel="stylesheet" href="client/css/index.css"></head><body class="bg-light"><main role="main"><span class="contents">`;
//html尾
IFR.htmlfoot = `</span></main></body></html>`;
//回复信息
IFR.comtool = `
<hr><form method="post" id="mesform" target = "_blank" action = "server/mess.php";><div class="form-group"><textarea  class="form-control" id="mestexts" name="mestexts" placeholder="内容..." style="background-color: #e8e7e3;" ></textarea></div>
    <input onclick="ifrsubmit()" type="submit" class="block btn btn-primary btn-sm" value="提交"></form><hr id="mesport">
`;
// IFR.shomcomments = function(){

// }
//创建<script>标签
IFR.js = DILOG.readiframe.contentDocument.createElement('script');
//<script>标签内的内容
IFR.js.innerHTML = `
 

//代码拷贝函数
copy = function(son){
    const tagtextarea = document.createElement('textarea');
    document.body.appendChild(tagtextarea);

    son.parentNode.setAttribute('id', 'copytemp');
    //tagtextarea.value = copytemp.innerText;
    tagtextarea.value = copytemp.innerText.replace("复制","");  //复制按钮去掉

    tagtextarea.select();
    if (document.execCommand('copy')) {
        document.execCommand('copy');
        //console.log('复制成功');
    }
    son.parentNode.setAttribute('id', '');
    document.body.removeChild(tagtextarea);

    son.innerText = "复制成功";
    setTimeout(function(){
        son.innerText = "复制";
    },1000);
}

var mesform = document.getElementById("mesform");   //读文章框架
var mestexts = document.getElementById("mestexts");   //读文章框架
var mesport = document.getElementById("mesport");   //读文章框架
//////提交文章//////
ifrsubmit = function(){
    // mesform.action = "temp.php";  //action修改
    // mesform.target = "_blank";  //action修改
    // mesform.submit();

    let pre = document.createElement("pre");
    let br = document.createElement("br");
    pre.setAttribute("id","message");
    pre.innerHTML = "<code>" + mestexts.value + "<code>";
     pre.style = "border-top: 7px;";
    mesport.appendChild(pre);
    pre.appendChild(br);

}
`;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// dilog /////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
                 // console.log(json);

                //转换为javascript的JSON
                json = JSON.parse(json);
                // DILOG.mess = json;
                 
                 if (json.tid != "") {
                     DILOG.ids.value = json.tid; 
                 }
                 if (json.ttit != "") {
                     DILOG.title.value = json.ttit + '|' + json.tgroup; 
                 }
                 if (json.tcont != "") {
                     DILOG.texts.value = json.tcont; 
                 }
                  //回调函数
                 huidiao(json);
            }
        }
}


//////readiframe高度 和 texts高度控制函数//////
DILOG.dilog = function(id) {
    let winheight =  window.innerHeight; //获取浏览器窗口高度
    winheight = Number(winheight);  //转为数子
    //修改readiframe高度
    if ( DILOG.readiframe === id ) {
        winheight = winheight * 0.81;  //
        DILOG.readiframe.height = winheight; //修改 
    }  
    //修改texts的高度
    if ( DILOG.texts === id ) {
        winheight = winheight * 0.70;  //
        DILOG.texts.style.height = winheight; //修改 
    }
}


///////页面格式化至id=readiframe iframe内//////
DILOG.page = function(json) {
    //用法，把所有<和>替换
    json.tcont = json.tcont.replaceAll("<","&lt;");
    json.tcont = json.tcont.replaceAll(">","&gt;");
    json.tcont = json.tcont.replaceAll("&lt;pre&gt;&lt;code&gt;","<pre><code>");
    json.tcont = json.tcont.replaceAll("&lt;/code&gt;&lt;/pre&gt;","</code></pre>");
    //替换代码复制
    json.tcont = json.tcont.replaceAll('<pre><code>','<pre><code><button class="copybtn btn btn-default btn-sm" onclick="copy(this)">复制</button>');

    // 发送html文件到readiframe 样式文件在 index.css 和 index.js 内
    DILOG.readiframe.contentWindow.document.body.innerHTML = IFR.htmlhead + json.ttit + '|' + json.tgroup + '<hr>' + json.tcont + IFR.htmlfoot + IFR.comtool;       
    //添加<script>标签添加到readiframe内
    DILOG.readiframe.contentWindow.document.body.appendChild(IFR.js); 
    //高度定义
    DILOG.dilog(DILOG.readiframe);
} 



//////记事本//////
DILOG.note = function() {
   //
  DILOG.name = "update";
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
  //输入框高度
  DILOG.dilog(DILOG.texts);
}

//////写文章//////
DILOG.instxt = function() {
    DILOG.name = "update";
   DILOG.tempifra.contentWindow.document.body.innerText = ""; 
    //关闭输入框
    DILOG.formtxt.style = "display:block;";
    DILOG.readiframe.style = "display:none;";
    //按钮打开
    DILOG.btnyl.style.display = "block"; 
    DILOG.btnbj.style.display = "block"; 
    DILOG.btnxg.style.display = "block"; 
    //
    DILOG.title.style.display = "block";
    //初始化
    DILOG.title.value = "";
    DILOG.texts.value = "";
    DILOG.ids.value = "";
    DILOG.gets('server/users.class.php?name=insert', DILOG.instxtpre);
  //输入框高度
  DILOG.dilog(DILOG.texts);
}

//////youtube//////
DILOG.ytb = function() {
    DILOG.name = "ytb";

    //关闭输入框
    DILOG.formtxt.style = "display:block;";
    DILOG.readiframe.style = "display:none;";
    //按钮打开
    DILOG.btnyl.style.display = "none"; 
    DILOG.btnbj.style.display = "none"; 
    DILOG.btnxg.style.display = "block"; 
    // DILOG.btndl.style.display = "none"; 
    //
    DILOG.title.style.display = "block";
    //初始化
    DILOG.title.value = "！YouTuBe下载！";
    DILOG.texts.value = "";
    DILOG.ids.value = "";
    //输入框高度
    DILOG.dilog(DILOG.texts);
}

//初始化输入框
DILOG.instxtpre = function(json) {
    DILOG.ids.value = json.tid;
    DILOG.title.value = json.ttit;
    DILOG.texts.value = json.tcont;
}


//////获取文章 并且显示//////
DILOG.showtxt = function(id) {
  //发送函数到
  // DILOG.gets('server/gettxt.php?id=' + id, DILOG.page);
  GET.get('server/gettxt.php?id=' + id, DILOG.page);

  DILOG.tempifra.contentWindow.document.body.innerText = ""; 

  DILOG.ids.value = id;
  //关闭输入框
  DILOG.formtxt.style = "display:none;";
  DILOG.readiframe.style = "display:block;";

  //按钮打开
  DILOG.btnyl.style.display = "block"; 
  DILOG.btnbj.style.display = "block"; 
  DILOG.btnxg.style.display = "block"; 
  //

    DILOG.ids.value = json.tid; 
    DILOG.title.value = json.ttit + '|' + json.tgroup; 
    DILOG.texts.value = json.tcont; 


}

//////编辑//////
DILOG.edittxt = function() {
  DILOG.name = "update";
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
  //替换特殊字符
  DILOG.texts.value = DILOG.texts.value.replaceAll(/<pre><code><button class="copybtn btn btn-default btn-sm" onclick="IFR.copy\(this\)">复制<\/button>/,'<pre><code>');  
  //输入框高度
  DILOG.dilog(DILOG.texts);
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
//
  DILOG.page({tid: "", ttit: DILOG.title.value, tcont: DILOG.texts.value});
}


//////删除文章//////
DILOG.delete = function(){
  //按钮
  DILOG.btnxg.style.display = "none"; 
  DILOG.btnyl.style.display = "none"; 
  DILOG.btnbj.style.display = "none"; 
  //get请求
  DILOG.gets("server/users.class.php?name=delete&id=" + DILOG.ids.value,reloadpage);
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
    formtxt.action = "server/users.class.php?name=" + DILOG.name + "&id=" + DILOG.ids.value;  //action修改
    DILOG.formtxt.target = "temp";  //action修改
    DILOG.yanzheng();
}


//刷新页面
reloadpage = function(){
  location.reload();
} 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// 框架内控制 /////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// var IFR = {};
