//  音频和视频播放器
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// 视频 /////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var XPlAYER = {};

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
  //标题和歌词
  lrcarr = path.split(".");
  titarr = lrcarr[0].split("/");
  names = titarr[2];
  lrcs = lrcarr[0] + ".lrc";
  //音乐
  const ap = new APlayer({
    container: document.getElementById('aplayer'),
    lrcType: 3, //歌词模式是 lrc文件
    mutex: true, //防止重复播放
    autoplay: true, //自动播放
    loop: 'all',  //循环
    audio: {
        name: names,
       // lrc: 'music/中文/F4-流星雨.lrc',
        lrc: lrcs,
        url: path
      }
  });
  bindEvent('aplayer');
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////口拖动 ///////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//https://blog.csdn.net/qq_25992675/article/details/108035725
//https://blog.csdn.net/weixin_40401500/article/details/98031116


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