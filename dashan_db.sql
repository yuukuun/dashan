-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2021-01-21 05:26:16
-- 服务器版本： 5.7.32-0ubuntu0.18.04.1
-- PHP 版本： 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `dashan123`
--

-- --------------------------------------------------------

--
-- 表的结构 `t_txt`
--

CREATE TABLE `t_txt` (
  `tid` bigint(20) NOT NULL COMMENT '文本ID',
  `uid` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `ttit` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '文本标题',
  `tcont` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT '文本内容',
  `tdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tprivate` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `t_txt`
--

INSERT INTO `t_txt` (`tid`, `uid`, `ttit`, `tcont`, `tdate`, `tprivate`) VALUES
(1, '1', '我的记事本(标题不可修改)', '66666666666666666', '2021-01-20 03:35:45', 0),
(2, '1', '出生时间的秘密与人类命运的规律', '    人有60亿，八字只有50多万种。60亿人，只有50多万种命运。《乾元秘旨》曰：“凡大富大贵之命，往往世不偶生，而贫贱者恒层叠出，何欤？盖天地精华，独酝酿于此一日，发泄于此一时。譬诸祥麟彩凤，原不多见，若泛泛化生于阴阳五行之内，不啻吠犬鸣鸡，何地无之。”\r\n    翻译：就是说大富大贵之命，世不偶生，出生的时候，同一时间也极少其他人出生，这类人的八字极少，大富大贵八字格局奇佳，难得一见，可遇不可求。同样时间出生的大命，一般1到3岁的时候，往往大病降临，这种病一般是要命的，十有九死，死了的那些生命就是福气不够了，死不了的就是大命了，所谓大难不死，必有后福。“不啻吠犬鸣鸡，何地无之”普通命，跟鸡狗一样，同一时间出生的人极多，哪里见不到呢。所以我们发现，双胞胎也是偶生，所以双胞胎大多也是普通命，大富大贵的双胞胎极少。\r\n    \r\n    我们发现八字，普通命的八字太多。富贵命的八字太少。八字充分反映出一个人与生俱来的福分，人的福气分成三六九等，并非八字本身会分配，人的出生时间是自己的因缘感应所致，人的出生的看似偶然，实际是福分大小的反映。虽然人的福分有三六九等，但人与人之间的相处，应该要平等的。人的大运十年一变，十年河西，十年河东。今天的锻炼，或者是明天的福气。今天的富贵，或者造成明天的贫贱。风水轮流转，祸福相依。古人云：“疑似之迹，不可不察。”指不被事物相似的表面现象所迷惑。\r\n\r\n    人有大命，所以古人说有虎命，龙命，鹤命，大命很少有，大命出生的时候，同一时间也极少其他人出生，跟老虎一样，每1到2年只生一胎而已。\r\n差命一大堆，扎堆而生，跟老鼠一样，同一时间出生的人极多，一生就一大窝，朝生暮死，醉生梦死，天地间的秘密和真理，小命们又知道多少呢，但是小命们有时凭人多势众却能主导这个社会，比如文革十年就这样，是流氓的天堂。\r\n    当然大命得看整体的八字结构了，跟属相无任何关系的。人中龙凤，万人之上，大富大贵的命，其因缘也殊胜的，其思想也奇异，很多大富大贵的人，思想格局很大，必有过人之处。\r\n\r\n60亿人，只有50多万种命运，人生的轨迹只有50多万种，所以相同八字的人的命运轨迹是很相似的，譬如3个相同八字的人，比如这一年霉运，有的可能失业、有的可能小破财，有的可能生病，有的可能出现身体的伤害，霉运时相同的，但是具体什么霉不一样的。\r\n譬如3个相同八字的人，比如这一年好运，有的可能发财、有的可能移民去美国（移民到发达国家也是一种财，成功移民那一年的财就抵消了，美国是生活优越的地方，美国低层的人，跟中国农村底层的人，不是一回事。不是人人能过美国的。移民美国，对于很多人来讲是天方夜谭），有的可能找到一个美女老婆，有的可能会学到一门高级的学问。\r\n    古人云：正财者，驿马也、妻也，才也。偏财者，驿马也，女人也，妾也，才也。\r\n    古人的富豪，妻妾多达几个到几十个，皇帝有后宫佳丽三千。\r\n\r\n八字与时俱进，当代人。老婆只得一个，偏财旺的人，变成招很多女人喜欢，人品差的富豪就出轨了，人品好的富豪，就控制得住。\r\n地域不同，差别也大。譬如相同八字的人，命中都有3个小孩，但是生于北方，计划生育严格，大多只有一胎。生在广东的潮汕地区，就最少得有3个。虽然个数不同，但是事业、财运、婚恋其他还是一样的。\r\n  譬如相同八字的人，在二十岁此年有婚恋的信息，在农村此年就会结婚了。在城市读大学的话，就会恋爱了。在欧美的话，必定要上床的，但绝对不结婚，欧美人大多晚婚。此年在国内发展，女友是中国人。此年在欧美留学，女友就是老外了。虽然恋爱是一样的，但机会不一样了\r\n\r\n  ，所以命运不是宿命的。此年如果有婚灾，不爱没事，一爱就出事。所以算命有明确规定，有人适合晚婚，早婚会有婚灾，不知道的话，人就被情所伤，这是很常见的。所以命运不是宿命的。有的人说我这辈子会有几个男人，这是也是不固定的，姻缘出现的时候，人来追你，你错  过了，你就没有。姻缘不是时时有的，一般的人，一辈子就只有几次的机会而已，错过了就没有。“我这辈子会有几个男人”这在古代的话，没女人敢问的。当代的话，很多女人都喜欢问这个，欧美人问这个就更加喜欢了。八字也要与时俱进的。\r\n所以相同八字的人，粗算每年的运气，发生的事是一样的，一生的起伏、财运大小、事业大小、婚姻也是一样的。譬如好运的流年，就是工作顺利，事业突破，财运翻倍，发财，有人来追求。全部是一样的。\r\n\r\n    但是相同八字的人，细算每年的运气，发生的具体何事就可能不一样了。譬如霉运因木受克的人，可能肝生病，可能破财，可能失业，可能家破，可能亲人生大病连累到自己。算准这个需要人的灵感，不过凭灵感就是算出今年发现的具体事情，譬如凭灵感能算出某年突然阳痿，但也不可能算出其他年份的具体事情，譬如某年一块石头从天而降，扎伤屁股。所以算这个无太大意义的。如果人人一样的话，那么人就是机器人了，面部一样，体重一样，手纹一样，每年发生的事都一模一样，这就是很宿命、很悲观、智商很低的人了。\r\n有的看了某某大师的算八字经典命例，说算得吃饭吃什么饭菜，具体得很厉害，结果自己去算，变成偷鸡不成蚀把米了。那是不合常理的。其实很多人，生活大多数时间都是很平淡的，哪有每个月都有不同的事情发生呢。\r\n\r\n    人有60亿，八字只有50多万种。所以相同八字的人，粗算一生财运起伏变化、一生的事业起伏变化、财运大小、事业大小、婚姻、是很相似的。不是相同的，只是很相似。\r\n细算的话，就有很多不同了，譬如那一年，相同八字的人工作和事业都很顺利，但是职业不一定相同。古人发明算命的时候，根本没有电脑行业、没有淘宝网、没有好声音、目前职业过万种，不可能一样的。\r\n\r\n    譬如那一年，相同八字的人都发财了，但具体做什么来发财也不一样的。\r\n八字却确实有一部分的人，人生的职业是规定好的，他自己没有选择的，譬如很多当官的、矿主、船主，有的人八字的格局气势明显，职业也是固定的，可以算出他的职业。大多数的人的八字就不是了，所以有的人这辈子做过很多行业，甚至做过几十种不同的工作。这就不能算出的。\r\n    相同八字的人，命运是相似，福报也是相似的，但不是相同的。生活中处处可见。命运有时可以改善的，一般小灾易躲，大灾难防。小财运易转运，大财、横财、偏财都是注定的，命无横财的人，没有人可以求到横财。同样，命带横财的人，我不求富贵，富贵逼人来。目前发现，命带横财的人，横财到的时候，真的是不求自得，天天坐在家里打麻将，不干活也有横财的，你看那些征地暴富的农民。命无横财，求得跳楼也没钱的，你看那些炒股而跳楼的。\r\n\r\n    如果一个人发现与自己同年同月同日生同时生的人越多，超多，就恭喜你了，送你一个悲催奖。因为物以稀为贵，八字也是一样的。大富大贵的八字难得一见，就譬如刘德华就只有一个，13亿人，全中国的大明星也没有1000个。但是普工一大堆，富士康手头上的普工就一百多万，连吃个便饭也要排队的，住几万元一晚的顶级酒店是很遥远的事情。刘德华住顶级酒店是很遥远的事情吗？人与人之间，福气之不同，不可思议。古人云，乐天知命故不忧。无财去炒股，会导致跳楼收场。无姻缘时盲目去爱，会导致婚姻不幸。凡事知命则安。有备无患。下雨前记得带伞。事先知道前面有个坎，得绕过去，否则就扑街了。我们算八字发现人的命运不是迷信的，不是宿命的，不是盲目的，是一种很理性的命运观点。但愿这个世界欢乐多一点，悲催少一点。南无阿弥陀佛，南无观世音菩萨。', '2021-01-21 05:25:50', 1),
(3, '1', 'Bootstrap v4', '利用 BootstrapCDN 和一个最简模板快速上手 Bootstrap。Bootstrap 是全球最流行的前端框架，用于构建响应式、移动设备优先的 WEB 站点。<pre><code>&lt;!doctype html&gt;\r\n&lt;html lang=\"en\"&gt;\r\n  &lt;head&gt;\r\n    &lt;!-- Required meta tags --&gt;\r\n    &lt;meta charset=\"utf-8\"&gt;\r\n    &lt;meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\"&gt;\r\n\r\n    &lt;!-- Bootstrap CSS --&gt;\r\n    &lt;link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css\" integrity=\"sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk\" crossorigin=\"anonymous\"&gt;\r\n\r\n    &lt;title&gt;Hello, world!&lt;/title&gt;\r\n  &lt;/head&gt;\r\n  &lt;body&gt;\r\n    &lt;h1&gt;Hello, world!&lt;/h1&gt;\r\n\r\n    &lt;!-- Optional JavaScript --&gt;\r\n    &lt;!-- jQuery first, then Popper.js, then Bootstrap JS --&gt;\r\n    &lt;script src=\"https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js\" integrity=\"sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj\" crossorigin=\"anonymous\"&gt;&lt;/script&gt;\r\n    &lt;script src=\"https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js\" integrity=\"sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo\" crossorigin=\"anonymous\"&gt;&lt;/script&gt;\r\n    &lt;script src=\"https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js\" integrity=\"sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI\" crossorigin=\"anonymous\"&gt;&lt;/script&gt;\r\n  &lt;/body&gt;\r\n&lt;/html&gt;</code></pre>', '2021-01-21 05:25:57', 0),
(4, '1', 'Centos 7 安装 Nginx', 'Centos 7 安装Nginx 自动化脚本\r\n<pre><code>#!/bin/bash\r\n### 初始化\r\n\r\n\r\n\r\nyum install -y gcc gcc-c++ vim libtool zip perl-core zlib-devel wget pcre* unzip automake autoconf make curl\r\n\r\n### 开始安装 nginx\r\ncd /tmp\r\nwget https://www.openssl.org/source/openssl-1.1.1a.tar.gz\r\ntar xzvf openssl-1.1.1a.tar.gz \r\nwget https://nginx.org/download/nginx-1.18.0.tar.gz && tar xf nginx-1.18.0.tar.gz && rm nginx-1.18.0.tar.gz && cd nginx-1.18.0\r\n./configure --prefix=/usr/local/nginx --with-openssl=../openssl-1.1.1a --with-openssl-opt=\'enable-tls1_3\' \\\r\n--with-http_v2_module --with-http_ssl_module --with-http_gzip_static_module --with-http_stub_status_module \\\r\n--with-http_sub_module --with-stream --with-stream_ssl_module\r\nmake && make install\r\n##################################################################################\r\n### nginx配置\r\n###nginx 启动\r\ncat &gt;/etc/systemd/system/nginx.service&lt;&lt;-EOF\r\n[Unit]\r\nDescription=nginx\r\nAfter=network.target\r\n[Service]\r\nType=forking\r\nExecStart=/usr/local/nginx/sbin/nginx\r\nExecReload=/usr/local/nginx/sbin/nginx -s reload\r\nExecStop=/usr/local/nginx/sbin/nginx -s quit\r\nPrivateTmp=true\r\n[Install]\r\nWantedBy=multi-user.target\r\nEOF\r\n\r\n/usr/local/nginx/sbin/nginx -t\r\nsystemctl start nginx.service\r\nsystemctl status nginx.service\r\nsystemctl enable nginx.service\r\n\r\n</code></pre>', '2021-01-21 05:26:10', 0);

-- --------------------------------------------------------

--
-- 表的结构 `t_user`
--

CREATE TABLE `t_user` (
  `uid` bigint(20) NOT NULL,
  `username` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` char(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `t_user`
--

INSERT INTO `t_user` (`uid`, `username`, `passwd`) VALUES
(1, 'admin', 'd6b89978d5418c1c5bd9d08453f3a020');

-- --------------------------------------------------------

--
-- 表的结构 `t_video`
--

CREATE TABLE `t_video` (
  `vid` bigint(20) NOT NULL COMMENT '视频ID',
  `vtit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '视频标题',
  `vurl` char(150) COLLATE utf8_unicode_ci NOT NULL COMMENT '视频地址',
  `vdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `t_video`
--

INSERT INTO `t_video` (`vid`, `vtit`, `vurl`, `vdate`) VALUES
(5, '网络—好听的动物音乐视频', 'bb54c69b78a8e87dc2e7b101316f3f4b', '2021-01-15 22:53:30'),
(6, '网络—现代电影预告片', '99d077ea1f8b93043b9c964837b089fa', '2021-01-15 23:54:16'),
(7, '网络—搞笑电影', '2f300cb4b50fa70686d82a55c22217a6', '2021-01-15 22:52:54'),
(12, '三国演义 第八集', '61d5704625c3cbb256e73fa4be713a74', '2021-01-16 02:54:13'),
(13, '孙燕姿 遇见', 'e79d3ebbd96c2ae5862c803601bba0e3', '2021-01-16 13:38:52');

--
-- 转储表的索引
--

--
-- 表的索引 `t_txt`
--
ALTER TABLE `t_txt`
  ADD PRIMARY KEY (`tid`);

--
-- 表的索引 `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`uid`);

--
-- 表的索引 `t_video`
--
ALTER TABLE `t_video`
  ADD PRIMARY KEY (`vid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `t_txt`
--
ALTER TABLE `t_txt`
  MODIFY `tid` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '文本ID', AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `t_user`
--
ALTER TABLE `t_user`
  MODIFY `uid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `t_video`
--
ALTER TABLE `t_video`
  MODIFY `vid` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '视频ID', AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
