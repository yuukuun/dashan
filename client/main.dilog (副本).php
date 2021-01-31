 <style type="text/css">
  .btn{
    float: top;
    float: right;
    margin: 4px;
  }
    .btnselect{
/*    float: top;*/
    float: right;
/*    margin: 6px;*/
  }
  .modal-content {
    padding: 1%;
  }

    #temp {
    margin-top: 4px;
    width: 100%;
    height: 30px;
/*    background-color: green;*/
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
    <!--   <div class="modal-header">    </div> -->
       <!--  <div class="modal-body"> </div>   -->
        <!-- 输入框 -->
        
          <div style="position: relative;"> 
           
           
        <!--     <iframe class="col-12 col-md-5" id="temp" name="temp" frameborder="no" marginwidth="0" marginheight="0" scrolling="yes"></iframe>  -->
            <button type="button" id="btngb"  class="btn btn-danger btn-sm" data-dismiss="modal">关闭</button> 
           
              
          <!--     如果登陆成功显示编辑按钮 -->
            <?php  if ( isset($_SESSION['username']) && isset($_SESSION['password']) ) {    
                echo "<button onclick=\"DILOG.preview()\" type=\"button\" id=\"btnyl\" class=\"btn btn-secondary btn-sm\">预览</button> ";
                echo "<button onclick=\"DILOG.edittxt()\" id=\"btnbj\" type=\"button\" class=\"btn btn-secondary btn-sm\">编辑</button>";  
                echo "<button onclick=\"DILOG.modfisubmit()\" id=\"btnxg\" type=\"button\" class=\"btn btn-primary btn-sm\">保存</button> ";
               // echo "<button id=\"btndl\" type=\"button\" class=\"btn btn-danger btn-sm\">删除</button> ";
                }     ?>
           
            <span id="btnbj"></span><span id="btnyl"></span><span id="btnxg"></span><span id="btngb"></span>
          <!--   <button onclick="DILOG.submit()" style="" id="btnbc" type="button" class="btn btn-primary btn-sm">保存</button>  -->
 <!----------------------------------------------- 分组 ----------------------------------------------------->
       
         <!--     <span class=" btnselect secondary">
              <form class="form-inline"><select class="custom-select my-1 mr-sm-2" id="sad">
                <option value="3">1</option>
                <option value="3">2</option>
                <option value="3">3</option>
                <option value="3">4</option>
              </select></form>
            </span> 
 -->

            <!-- <button onclick="DILOG.submit()" style="" id="btnbc" type="button" class="btn btn-primary btn-sm">保存</button>  -->
         <!--    <button onclick="DILOG.getadmin()" id="btnht" type="button" class="btn btn-danger btn-sm">后台</button>  -->

            <!--  文章显示 -->
            <!-- <div class="form-group"></div>
 -->
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
<!--           <iframe id="readiframe" name="readiframe" frameborder="no"  marginwidth="0" marginheight="0" scrolling="yes" width="100%" height="580px" onload="readiframe.focus()"></iframe>  -->
          <iframe id="readiframe" name="readiframe" frameborder="no"  marginwidth="0" marginheight="0" scrolling="yes" width="100%"></iframe> 
          <!-- <iframe id="mesiframe" name="mesiframe" frameborder="no"  marginwidth="0" marginheight="0" scrolling="yes" width="100%" height="100px" style="background-color: red;"></iframe>  -->
          <textarea class="form-control" class="messageedit"></textarea> <button type="button" class="btn btn-primary btn-sm">提交</button>
    <!--       <textarea class="message">
            <pre><code></code></pre>  <button type="button" class="btn btn-danger btn-sm">提交</button>
          </textarea> -->

         
          <div>  
          <!-- 关闭按钮 -->
           <?php  if ( isset($_SESSION['username']) && isset($_SESSION['password']) && $_GET['s'] != "" ) {    
               echo "<button onclick=\"DILOG.delete()\" id=\"btndl\" type=\"button\" class=\"btn btn-danger btn-sm\"  data-dismiss=\"modal\">删除</button>";
              }    
            ?>
            <!-- 返回信息框 -->
            <iframe class="col-8 col-md-5" id="temp" name="temp" frameborder="no" marginwidth="0" marginheight="0" scrolling="yes"></iframe> 
          </div>   

    </div>
  </div>
</div>


<iframe style="display: none;" id="temps" name="temps" ></iframe>


