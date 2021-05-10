<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"E:\web\site/application/index\view\index\index.html";i:1495860270;s:44:"E:\web\site/application/index\view\base.html";i:1495860404;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>五合新能源</title>
		<meta name="description" content="{dede:global.cfg_description/}" />
		<meta name="keywords" content="{dede:global.cfg_keywords/}" />
		<meta name="author" content="design by www.dede58.com" />
		<link href="/skin/css/reset.css" rel="stylesheet" type="text/css" />
		<link href="/skin/css/common.css" rel="stylesheet" type="text/css" />
		<link href="/skin/css/index.css" rel="stylesheet" type="text/css" />
		<link href="/skin/css/temp.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="/skin/js/index.js"></script>
		<script type="text/javascript" src="/skin/js/msclass.js"></script>
		<script src="/skin/js/scrollpic.js" type="text/javascript"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="/skin/js/jquery.js"></script>
		<meta http-equiv="mobile-agent" content="format=xhtml;url={dede:global.cfg_mobileurl/}/index.php">
		<script type="text/javascript">
			if(window.location.toString().indexOf('pref=padindex') != -1) {} else {
				if(/AppleWebKit.*Mobile/i.test(navigator.userAgent) || (/MIDP|SymbianOS|NOKIA|SAMSUNG|LG|NEC|TCL|Alcatel|BIRD|DBTEL|Dopod|PHILIPS|HAIER|LENOVO|MOT-|Nokia|SonyEricsson|SIE-|Amoi|ZTE/.test(navigator.userAgent))) {
					if(window.location.href.indexOf("?mobile") < 0) {
						try {
							if(/Android|Windows Phone|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) {
								window.location.href = "{dede:global.cfg_mobileurl/}/index.php";
							} else if(/iPad/i.test(navigator.userAgent)) {} else {}
						} catch(e) {}
					}
				}
			}
		</script>
	</head>

	<body>
		<div class="header">
			<div class="hd_top tr">
				<div class="container"> <em class="fl">欢迎光临织梦58科技有限公司！</em> <span class="fr"> <a href="/a/guanyuwomen/">关于我们</a>  | <a href="/a/lianxiwomen/">联系我们</a> | <a href="#liuyan">在线留言</a> </span> </div>
			</div>
			<div class="hd_cont container">
				<dl class="hd_logo">
					<dt class="fl"><a href="/"> <img src="/skin/images/logo.png" alt="营销型大气机械设备类企业网站织梦模板(带手机端)" /></a></dt>
					<dd class="fl">
						<h2> 专注节能15年 打造中国最节能的空压机</h2>
					</dd>
				</dl>
				<dl class="dh_phone fr">
					<dt>全国统一服务热线</dt>
					<dd> 400-900-8899</dd>
				</dl>
			</div>
			<div class="dh_nav">
				<ul class="container">
					<li class='home'>
						<a class="navHome" href="/a/index.htm">网站首页</a>
					</li>
					<li>
						<a href='/a/guanyuwomen/' class='cur'>关于我们</a>
					</li>
					<li>
						<a href="/a/chanpinzhongxin/">产品中心</a>
					</li>

					<li>
						<a href="/a/chenggonganli/">成功案例</a>
					</li>

					<li>
						<a href="/a/fuwuzhongxin/">服务中心</a>
					</li>

					<li>
						<a href="/a/zixunzhongxin/">资讯中心</a>
					</li>

					<li>
						<a href="/a/gongsishili/">公司实力</a>
					</li>

					<li>
						<a href="/a/lianxiwomen/">联系我们</a>
					</li>

				</ul>
			</div>
		</div>
		<div class="bannerBox">
			<div id="flashs">
				<div class="bgitem" id="flashbg0" style="background: url('/skin/images/banner3.jpg') no-repeat scroll center top;
                height: 420px; width: 100%; cursor: pointer; margin: 0 auto;">
					<a href="/plus/view.php?aid=92"></a>
				</div>
				<div class="bgitem" id="flashbg1" style="background: url('/skin/images/banner2.jpg') no-repeat scroll center top;
                height: 420px; width: 100%; cursor: pointer; margin: 0 auto;">
					<a href="/plus/view.php?aid=91"></a>
				</div>
				<div class="bgitem" id="flashbg2" style="background: url('/skin/images/banner1.jpg') no-repeat scroll center top;
                height: 420px; width: 100%; cursor: pointer; margin: 0 auto;">
					<a href="/plus/view.php?aid=90"></a>
				</div>
				<script type="text/javascript" src="/skin/js/flash.js"></script>
			</div>
		</div>
		
<div class="mainContent">
  <div class="search container">
    <div class="searchBox">
      <form  name="formsearch" action="/plus/search.php">
        <input class="soText" type="text" id="seachkeywords" name="q" />
        <input class="soBtn curp" type="submit" value=""   onclick="xuanze()" />
      </form>
    </div>
    <span class="keyWord"><em>热门关键词：</em> <em id="commonHeaderkeywords">{dede:hotwords num='6'/} </em></span> </div>
  <div class="cpSpan container">
    <div class="cpMu fl">
      <h4> {dede:type typeid='1'} <a href="[field:typelink/]"> [field:typename/]</a>{/dede:type} </h4>
      <div class="cpMuCont">
        <ul>
          {dede:channel type='son' typeid='1'}
          <li><a href="[field:typeurl/]"> [field:typename/]</a></li>
          {/dede:channel}
        </ul>
        <p> 您只需一个电话我们将提供最合适的产品，让您花最少的钱，达到最好的效果</p>
        <dl class="mu_phone">
          <dt>全国统一服务热线</dt>
          <dd> {dede:global.cfg_tel/}</dd>
        </dl>
      </div>
    </div>
    <div class="cpList fr">
      <h4> {dede:type typeid='1'} <a href="[field:typelink/]"> 推荐产品</a>{/dede:type}</h4>
      <div class="cpListCont"> {dede:arclist typeid='1' row='12' titlelen='50' orderby='pubdate'}
        <dl>
          <dt><a href="[field:arcurl/]" title="[field:title/]"> <img src="[field:picname/]" alt="[field:title/]" title="[field:title/]"
                            width="180" height="150"></a></dt>
          <dd>
            <h5> <a href="[field:arcurl/]" title="[field:title/]">[field:title/]</a></h5>
          </dd>
        </dl>
        {/dede:arclist} </div>
    </div>
    <div class="clear"> </div>
  </div>
  <div class="slGgl container"> <img src="/skin/images/slgglimg.jpg" alt="" /></div>
  <div class="ysBox container">
    <dl class="ys01">
      <dt><b>01</b>国家一级节能认证</dt>
      <dd> 采用稀土永磁变频电机不用时处于休眠状态与同类产品相比省电约30%-50%</dd>
    </dl>
    <dl class="ys02">
      <dt><b class="lv">02</b>智能控制技术</dt>
      <dd> 可根据客户的用气量自动调节电机的转速，用户可远程查看和控制，真正做到了运行现场无人值守</dd>
    </dl>
    <dl class="ys03">
      <dt><b class="lv">03</b>效率提高30%以上</dt>
      <dd> 压缩效率高，传动效率达到100%，与同类产品相比，效率提高30%以上。</dd>
    </dl>
    <dl class="ys04">
      <dt><b>04</b>运行时噪音低于50分贝</dt>
      <dd> 用户在其附近打电话不受影响，可直接安装在生产现场，
        <p> 不会产生噪音污染源</p>
      </dd>
    </dl>
  </div>
  <div class="gdn container">
    <h4 class="contTit"> {dede:type typeid='13'} <a class="titA" href="[field:typelink/]">[field:typename/]</a>{/dede:type} {dede:type typeid='13'} <a class="titMore" href="[field:typelink/]">更多</a>{/dede:type} </h4>
    <ul>
      {dede:arclist typeid='13' row='4' titlelen='50' orderby='pubdate'}
      <li><a href="[field:arcurl/]" title="[field:title/]"> <img alt="[field:title/]" src="[field:picname/]" width="218" height="164" /></a>
        <h5> <a href="[field:arcurl/]" title="[field:title/]"> [field:title/]</a></h5>
      </li>
      {/dede:arclist}
    </ul>
  </div>
  <div class="ktSpan container">
    <div class="khjz fl">
      <h4 class="contTit"> {dede:type typeid='39'} <a class="titA" href="[field:typelink/]">[field:typename/]</a>{/dede:type}{dede:type typeid='39'} <a class="titMore" href="[field:typelink/]">更多</a>{/dede:type}</h4>
      <div class="khCont"> {dede:arclist typeid='39' row='2' titlelen='50' orderby='pubdate'}
        <dl>
          <dt class="fl"><a href="[field:arcurl/]" title="[field:title/]"> <img alt="[field:title/]" src="[field:picname/]" width="224" height="174" /></a></dt>
          <dd>
            <h5> <a href="[field:arcurl/]" title="[field:title/]"> [field:title/]</a></h5>
            <p> <br/>
              [field:description function="cn_substr(@me,200)"/]...</p>
            <a class="btnGd" href="[field:arcurl/]">查看更多</a> </dd>
        </dl>
        {/dede:arclist} </div>
    </div>
    <div class="tdBox fr">
      <h4 class="contTit"> {dede:type typeid='40'} <a class="titA" href="[field:typelink/]">[field:typename/]</a>{/dede:type}</h4>
      <ul id="tuandui">
        {dede:arclist typeid='40' row='2' titlelen='50' orderby='pubdate'}
        <li><a href="[field:arcurl/]" title="[field:title/]"> <img alt="[field:title/]" src="[field:picname/]" width="274" height="178"
                        alt="" /></a>
          <h5> <a href="[field:arcurl/]" title="[field:title/]">[field:title/]</a></h5>
        </li>
        {/dede:arclist}
      </ul>
    </div>
    <div class="clear"> </div>
  </div>
  <!-- 广告栏 -->
  <div class="ggl container"> <img src="/skin/images/gglimg.jpg" alt="" /> <span> {dede:global.cfg_tel/}</span> </div>
  <div class="gcSpan container">
    <div class="gyBox fl">
      <h4 class="contTit"> {dede:type typeid='25'} <a class="titA" href="[field:typelink/]">[field:typename/]</a>{/dede:type}</h4>
      <div class="gyCont">
        <dl>
          <dt class="fl"> <img src="/skin/images/20150528151454_94670.jpg" alt="关于我们" width="282" height="206" /></dt>
          <dd>
            <h5> {dede:type typeid='25'} <a href="[field:typelink/]">织梦58</a>{/dede:type} </h5>
            <p>{dede:sql sql='Select content from dede_arctype where id=24'} 
              [field:content  function='cn_substr(html2text(@me),480)'/]...
              {/dede:sql}...</p>
            {dede:type typeid='25'} <a class="gyMore" href="[field:typelink/]">查看更多</a>{/dede:type} </dd>
        </dl>
        <div class="cjBox">
          <div class="cjTit"> {dede:type typeid='42'} <a href="[field:typelink/]">[field:typename/]</a>{/dede:type} </div>
          <ul id="chej">
            {dede:arclist typeid='42' row='4' titlelen='50' orderby='pubdate'}
            <li><a href="[field:arcurl/]" title="[field:title/]"> <img alt="[field:title/]" src="[field:picname/]" width="146" height="106" /></a>
              <h5> <a href="[field:arcurl/]" title="[field:title/]"> [field:title/]</a></h5>
            </li>
            {/dede:arclist}
          </ul>
        </div>
      </div>
    </div>
    <div class="wtjd fr">
      <h4 class="contTit"> {dede:type typeid='37'} <a class="titA" href="[field:typelink/]"> [field:typename/]</a>{/dede:type} </h4>
      <div class="wtjdCont">
        <div id="faq"> {dede:arclist typeid='37' row=6 infolen='200' titlelen=60}
          <dl>
            <dt><a href="[field:arcurl/]" title="[field:title/]"> [field:title/]</a></dt>
            <dd> [field:info/]...</dd>
          </dl>
          {/dede:arclist} </div>
      </div>
    </div>
    <script type="text/javascript">

    new Marquee("faq", 0, 1, 306, 392, 40, 0, 1000, 22); 
</script>
    <div class="clear"> </div>
  </div>
  <!-- 加盟直通车 -->
  
  <div class="dySpan container">
    <div class="dtBox fl">
      <div class="dtTab"> <span class="cur" onclick="window.open('/a/zixunzhongxin/gongsidongtai/')"> 公司动态</span> <span class="" onclick="window.open('/a/zixunzhongxin/xingyedongtai/')"> 行业动态</span> </div>
      <div class="cpConts" > {dede:arclist typeid='35' limit='0,1' infolen='120'}
        <dl>
          <dt class="fl"><a href="[field:arcurl/]" title="[field:title/]"> <img src="[field:picname/]" width="146" height="102" alt="[field:title/]" /></a> </dt>
          <dd>
            <h5> <a href="[field:arcurl/]" title="[field:title/]"> [field:title/]</a></h5>
            <p> [field:info/]...</p>
          </dd>
        </dl>
        {/dede:arclist}
        <ul>
          {dede:arclist typeid='35' limit='1,5' titlelen=60}
          <li><a href="[field:arcurl/]" title="[field:title/]"> [field:title/]</a><span>[[field:pubdate function="MyDate('Y-m-d',@me)"/]]</span></li>
          {/dede:arclist}
        </ul>
      </div>
      <div class="cpConts" style='display: none;'> {dede:arclist typeid='36' limit='0,1' infolen='120'}
        <dl>
          <dt class="fl"><a href="[field:arcurl/]" title="[field:title/]"> <img src="[field:picname/]" width="146" height="102" alt="[field:title/]" /></a> </dt>
          <dd>
            <h5> <a href="[field:arcurl/]" title="[field:title/]"> [field:title/]</a></h5>
            <p> [field:info/]...</p>
          </dd>
        </dl>
        {/dede:arclist}
        <ul>
          {dede:arclist typeid='36' limit='1,5' titlelen=60}
          <li><a href="[field:arcurl/]" title="[field:title/]"> [field:title/]</a><span>[[field:pubdate function="MyDate('Y-m-d',@me)"/]]</span></li>
          {/dede:arclist}
        </ul>
      </div>
    </div>
    <script type="text/javascript">

    $('.dtBox .dtTab span').mouseover(function () {
        $(this).addClass("cur").siblings().removeClass("cur");
        //$("#curUrl2").attr("href", $(this).find("a").attr("href"));
        $(".dtBox .cpConts").eq($('.dtBox .dtTab span').index(this)).show().siblings(".cpConts").hide();
    });
</script> 
    
    <!-- 在线留言 -->
    <div class="lyBox fr" id="liuyan">
      <h4 class="contTit"> <a class="titA">在线留言</a></h4>
      <div class="lyCont"> <span class="fPhone"> {dede:global.cfg_tel/}</span>
        <ul class="m_form">
          <form action="/plus/diy.php" enctype="multipart/form-data" method="post">
            <input type="hidden" name="action" value="post" />
            <input type="hidden" name="diyid" value="1" />
            <input type="hidden" name="do" value="2" />
            <li>
              <label> <img _src="/skin/images/form_ico01.png" /></label>
              <input class="iptTxt" type='text' name='name' id='name' value="联  系 人 ："  onfocus="this.value=''" onblur="if(this.value=='')this.value='联  系 人 ：'" />
            </li>
            <li>
              <label> <img _src="/skin/images/form_ico02.png" /></label>
              <input class="iptTxt"  type='text' name='tel' id='tel' type="text" value="联系方式："  onfocus="this.value=''" onblur="if(this.value=='')this.value='联系方式：'" />
            </li>
            <li>
              <label> <img _src="/skin/images/form_ico03.png" /></label>
              <input class="iptTxt" type='text' name='email' id='email' value="电子邮箱："  onfocus="this.value=''" onblur="if(this.value=='')this.value='电子邮箱：'" />
            </li>
            <li class="areLi">
              <label> <img _src="/skin/images/form_ico04.png" /></label>
              <textarea class="txtAre" type='text' name='content' id='content' onfocus="this.value=''" onblur="if(this.value=='')this.value='留       言：'">留       言：</textarea>
            </li>
            <input type="hidden" name="dede_fields" value="name,text;tel,text;email,text;content,text" />
            <input type="hidden" name="dede_fieldshash" value="877b0484352c0bb6689972090e73d6d9" />
            <li>
              <input class="btnSubmit" type="submit" name="submit" value="" onclick="subLeaveword(this)" />
            </li>
          </form>
        </ul>
      </div>
    </div>
    <div class="clear"> </div>
  </div>
</div>

		<div class="footWrap">
			<div class="footer">
				<div class="fotBai">
					<div class="fotNav">
						<a href="/a/guanyuwomen/">关于我们</a>
						<a href="/a/chanpinzhongxin/">产品中心</a>
						<a href="/a/chenggonganli/">成功案例</a>
						<a href="/a/fuwuzhongxin/">服务中心</a>
						<a href="/a/zixunzhongxin/">资讯中心</a>
						<a href="/a/gongsishili/">公司实力</a>
						<a href="/a/lianxiwomen/">联系我们</a>
						<a class="noBg" href="/">网站首页</a>
					</div>
				</div>
				<div class="ewmImg"> <img src="/skin/images/ewmimg.jpg" width="164" height="164" alt="" /></div>
				<div class="fotTxt"> Copyright &copy; 2002-2011 DEDE58.COM 织梦模板 版权所有
					<a href=http://www.dedecms.com target='_blank'>Power by DedeCms</a><br /> 地址：海口市港澳开发区 <br /> 电话：13956956696 邮箱：695968569@qq.com 技术支持:
					<a href="http://www.dede58.com/" target="_blank">织梦58 </a><br> ICP备案号：
					<a href="http://www.miitbeian.gov.cn" target="_blank">粤ICP备12028954号</a>
				</div>
				<dl class="fotPhone">
					<dt>全国免费咨询热线</dt>
					<dd> 400-900-8899</dd>
				</dl>
			</div>
		</div>

		<!--页面JS脚本-->
		
	</body>

</html>