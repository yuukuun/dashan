<link rel="stylesheet" href="aplayer/APlayer.min.css">
<style type="text/css">


#aplayer {
    position: fixed;cursor: pointer;
    height: 100px;
 /*    width: 250px; height: 100%;*/
      padding-top: 23px;
      /*background-color: #ccccca;*/
      bottom: 13px;
    box-shadow: 0px 0px 11px #DCDCDC;
}

</style>

<!-- <div class="container navbar-fixed-bottom"> -->
<div class="container" >
<div class="musicdiv" id="aplayer"><div>
<div>



<script src="aplayer/APlayer.min.js"></script>



<script type="text/javascript">
function audio(urls){
        const ap = new APlayer({
        container: document.getElementById('aplayer'),
        audio: [{
             mutex: true,    //防止重复播放
            autoplay: true, //自动播放
            preload: 'auto',
            loop: 'all',
            lrcType: 3, //歌词模式是 lrc文件
            name: '我的回忆不是我的',
            //artist: 'artist',
            //url: 'aplayer/海鸣威-我的回忆不是我的.wav'
            url: urls
            //lrc: '音乐/中文/周传雄-寂寞沙洲冷.lrc'
            //cover: 'cover.jpg'
        }]
    }); 
}


////////////////////////// div拖动 //////////////////////////
//封装了一个取消默认事件的函数，用来兼容老IE
function cancelHandler(event){
    if (event.preventDefault) {
      event.preventDefault();
    } else {
      event.returnValue = false;
    }
  }
 
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
//bindEvent('moveplayer');
bindEvent('aplayer');



</script>
