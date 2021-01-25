<?php

/////////////////////////////////////////////////////// 引入 selected///////////////////////////////////////////////////////
// require_once "client/main.dilog.php";	//弹框文件
require_once "client/html.header.html";	//头部静态文件
// require_once "mysql.php";	//数据库

?>
<style type="text/css">
	   pre {
    position: relative;
    border-radius: 5px;
    padding: 1px;
    width: 100%;

      padding: 7px;
       border-radius: 4px;
       font: 14px arial,sans-serif; 
       background-color: #2E3436;
       color: #e8e7e3;
  
  }
  .copybtn {

 /*   float: right;
    float: top;*/
    position: fixed;
    right: 12px;
/*    top: 10px;*/
    background-color: gray;

  }



</style>



<pre><code><button class="copybtn btn btn-default btn-sm" onclick="IFR.copy(this)">复制</button>
###安装。根据官方安装
yum remove epel-release

yum install -y epel-release

yum install -y certbot python2-certbot-nginx
</code></pre>
<pre><code><button class="copybtn btn btn-default btn-sm" onclick="IFR.copy(this)">复制</button>
###出错就解决
pip install --upgrade --force-reinstall 'requests==2.6.0' urllib3
 
###单域名证书
certbot certonly --webroot -w /usr/local/nginx/html/ -d baidu.com -m 0@yahoo.com --agree-tos --test-cert -n    ### --test-cert测试模式 -n不交互
 
</code></pre>

<pre><code><button class="copybtn btn btn-default btn-sm" onclick="IFR.copy(this)">复制</button>
###通配符域名证书
certbot -d baidu.cn -d '*.baidu.com' --manual --preferred-challenges dns-01 --server https://acme-v02.api.letsencrypt.org/directory certonly -m 123@gmail.com --agree-tos
###续费
echo '5 4 * * 2 /usr/bin/certbot renew --dry-run "/usr/local/nginx/sbin/nginx -s reload"' >> /var/spool/cron/root
###删除
certbot certificates
certbot delete --cert-name example.com
 </code></pre>


<script type="text/javascript">
// https://github.com/axuebin/articles/issues/26
//https://blog.csdn.net/jenyzhang/article/details/48777251
//https://www.shuzhiduo.com/A/q4zVjN2GzK/

var IFR = {};
IFR.copy = function(son){
    const tagtextarea = document.createElement('textarea');
    document.body.appendChild(tagtextarea);

    
    son.parentNode.setAttribute('id', 'copytemp');
    tagtextarea.value = copytemp.innerText;

    tagtextarea.select();
    if (document.execCommand('copy')) {
        document.execCommand('copy');
        console.log('复制成功');
    }
    son.parentNode.setAttribute('id', '');
    document.body.removeChild(tagtextarea);

    son.innerText = "复制成功";
    setTimeout(function(){
        son.innerText = "复制";
    },1000);
}

</script>








<?php

// echo $_POST['sss'];
// echo $_GET['sss'];

///////////////////////////////////////////////////////引入 ///////////////////////////////////////////////////////
// require_once "client/html.footer.html";	//尾静态文	

?>



