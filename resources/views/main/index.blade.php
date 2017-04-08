<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>合肥工业大学化学实验室安全教育与考试系统</title>
<link href="style/index.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.bootcss.com/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jcarousellite.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
</head>

<body>
<div class="top"><img src="images/logo.png" width="397" height="115" /></div>
<div class="head"><p><img src="images/q8.png" width="75" height="42" /><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;化&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;实&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;验&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;室&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;安&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 全&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 教&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 育&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;与&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 考&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;试&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 系&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;统&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><img src="images/q8.png" width="75" height="42" /></p></div>
<div class="main">
	<div class="nav">
    	<ul>
        	<li><a href="/categories"></a><img src="images/q1.jpg" width="52" height="80" /><p><font style="font-size:24px;">在线学习</font><br />
<span>LEARNING</span></p></li>
            <li><a href="/papers"></a><img src="images/q1.jpg" width="52" height="80" /><p><font style="font-size:24px;">在线考试</font><br /><span>EXAMINATION </span></p></li>
            <li style="margin-right:0;"><a href="/login"></a><img src="images/q1.jpg" width="52" height="80" /><p><font style="font-size:24px;">用户登录</font><br /><span>USER LOGIN</span></p></li>
        </ul>
    </div>
    <div class="con1">
        <div class="ad">
        	<div class="carousel">
		<a href="javascript:void(0);" class="prev" id="prev-01">&nbsp </a>
		<div class="jCarouselLite" id="demo-01">
			<ul>
				<li><a href="" target="_blank"><img src="images/hfut.png" width="492" height="287" /></a><p>学校展示图片</p></li>
				<li><a href="" target="_blank"><img src="images/hfut.png" width="492" height="287" /></a><p>111111</p></li>
                <li><a href="" target="_blank"><img src="images/hfut.png" width="492" height="287" /></a><p>22222</p></li>
                <li><a href="" target="_blank"><img src="images/hfut.png" width="492" height="287" /></a><p>33333</p></li>
                <li><a href="" target="_blank"><img src="images/hfut.png" width="492" height="287" /></a><p>44444</p></li>
			</ul>
		</div>
		<a href="javascript:void(0);" class="next" id="next-01">&nbsp </a>
		<div class="clear"></div>   
	</div><!--carousel end-->
	<script type="text/javascript">
	$(document).ready(function(){
		$('#demo-01').jCarouselLite({
			btnPrev: '#prev-01',
			btnNext: '#next-01',
			visible:1
		});		
	});
	</script>
        </div>
        <div class="news">
            <div class="new_t"><a href="/categories/2">查看更多></a>最新公告<img src="images/ii.png" width="319" height="10" /></div>
            <ul>
                @foreach($data['notices'] as $notice)
                    <li><span>{{ $notice->created_at->format('Y-m-d') }}</span><a href="{{ url('article/'.$notice->id) }}">{{ str_limit($notice->title,25) }}</a></li>
                @endforeach
            </ul>
        </div>
	</div>
   
</div>
<div class="con2"><p><span><a href="/categories/3"><img src="images/q4.png" width="156" height="156" /></a></span><span><a href="/categories/4"><img src="images/q5.png" width="156" height="156" /></a></span><span><a href="categories/5"><img src="images/q6.png" width="156" height="156" /></a></span><span><a href="categories/6"><img src="images/q9.png" width="156" height="156" /></a></span></p></div>
 <div class="foot">通讯地址： 安徽省宣城市宣州区薰化路301号</div>
</body>
</html>
