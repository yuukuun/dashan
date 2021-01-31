 <style type="text/css">
  .btn{
    float: top;
    float: right;
    margin: 4px;
  }

    .btnselect{
    float: right;
  }

  .modal-content {
    padding: 1%;
  }

  #temp {
    margin-top: 4px;
    width: 100%;
    height: 30px;
  }

  #readiframe {
  /*  border:25px;*/
/*  padding: 7px;*/
    /*background-color: gray;*/
  }
</style>



<!-------------------------------------------------- 文本编辑------------------------------------------------------>
<!----------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="write" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div id="dialogdx" class="modal-dialog modal-xl" > <!--modal-xl  modal-lg modal-sm -->
    <div class="modal-content">
        
          <div style="position: relative;"> 
            <button type="button" id="btngb"  class="btn btn-danger btn-sm" data-dismiss="modal">关闭</button> 
           
          <!--     如果登陆成功显示编辑按钮 -->
            <?php  if ( isset($_SESSION['username']) && isset($_SESSION['password']) ) {    
                echo "<button onclick=\"DILOG.preview()\" type=\"button\" id=\"btnyl\" class=\"btn btn-secondary btn-sm\">预览</button> ";
                echo "<button onclick=\"DILOG.edittxt()\" id=\"btnbj\" type=\"button\" class=\"btn btn-secondary btn-sm\">编辑</button>";  
                echo "<button onclick=\"DILOG.modfisubmit()\" id=\"btnxg\" type=\"button\" class=\"btn btn-primary btn-sm\">保存</button> ";
                }     ?>
           
            <span id="btnbj"></span><span id="btnyl"></span><span id="btnxg"></span><span id="btngb"></span>


            <!-- 表单 -->
            <form method="post" id="formtxt">
              <div class="form-group"> <input scrolling="no" type="hidden" class="form-control" id="ids" name="ids"></div>
              <!-- 标题输入 --><div id="txtedit">
              <div class="form-group"><input type="text" class="form-control" id="title" name="title" value="" placeholder="标题..."  style="background-color: #e8e7e3;"></div>
              
              <!-- 文本输入框 -->
              <div class="form-group"> <textarea  class="form-control" id="texts" name="texts" placeholder="内容..." style="background-color: #e8e7e3;" ></textarea></div></div>
            </form>
          </div>


          <!-- 主要显示显示div -->
          <iframe id="readiframe" name="readiframe" frameborder="no"  marginwidth="0" marginheight="0" scrolling="yes" width="100%"></iframe> 

          <div><div id="mesformdiv">
            <form method="post" id="mesform" target="temp" action="server/mess.php">
        <!--      <div class="form-group"> <textarea class="form-control" id="mestexts" name="mestexts" placeholder="内容..." style="background-color: #e8e7e3;"></textarea></div>  -->
            <textarea class="form-control" id="mestexts" name="mestexts" placeholder="内容..." ></textarea>
            <input type="hidden" class="form-control" id="mestid" name="mestid">
            <input onclick="ifrsubmit()" id="messubmit" type="submit" class="block btn btn-primary btn-sm" value="留言"></div>   
             <!-- 关闭按钮 -->
          <?php  if ( isset($_SESSION['username']) && isset($_SESSION['password']) && $_GET['s'] != "" ) {    
               echo "<button onclick=\"DILOG.delete()\" id=\"btndl\" type=\"button\" class=\"btn btn-danger btn-sm\"  data-dismiss=\"modal\">删除</button>";
              }  ?>  
            
            </form>

         
            
            <!-- 返回信息框 -->
            <iframe class="col-8 col-md-5" id="temp" name="temp" frameborder="no" marginwidth="0" marginheight="0" scrolling="yes"></iframe> 
          </div>   

    </div>
  </div>
</div>

<script type="text/javascript">
// var mesform = document.getElementById("mesform");   //读文章框架
var mestexts = document.getElementById("mestexts");   //读文章框架
// var mestid = document.getElementById("mestid");   //读文章框架
// var mesport = document.getElementById("mesport");   //读文章框架
//////提交文章//////
ifrsubmit = function(){
      mestid.value = DILOG.ids.value;
      // let mes = `<pre id="message"><code>` + mestexts.value + `</code></pre>`;
      //  DILOG.readiframe.contentWindow.document.body.appendChild(mes); 

    let pre = document.createElement("pre");
    let br = document.createElement("br");
    pre.setAttribute("id","message");

    let temp = mestexts.value.replaceAll("<","&lt;");
    temp = temp.replaceAll(">","&gt;");

    pre.innerHTML = "<code>" + temp + "<code>";

    //DILOG.readiframe.contentWindow.document.body.appendChild(pre); 
    DILOG.readiframe.contentWindow.document.getElementById('ifrmess').appendChild(pre); 

    // mestexts.value = "";
    // let obj =  DILOG.readiframe.contentWindow; 
    // let tags = obj.document.getElementById('ifrmess');
    // tags.innerHTML = `<pre id="message"><code>`+ mestexts.value +`</code></pre>`;;


    
    
     // pre.style = "border-top: 7px;";
    // mesport.appendChild(pre);
    // pre.appendChild(br);
}

// DILOG.readiframe.contentWindow.document.body.appendChild(mesport); 
</script>


<!-- <pre id="message"><code></code></pre>
<span ></span> -->
<!-- 
</div st>
  <iframe style="display: none;" id="temps" name="temps" ></iframe> -->


