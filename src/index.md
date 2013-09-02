

<div class="text-center" id="show-off">
<!--首焦图片-->
</div>

<p></p>

# What is KISSY?

KISSY 是一款跨终端、模块化、使用简单的 JavaScript 框架。除了完备的工具集合诸如 DOM、Event、Ajax、Anim 等，KISSY 还面向团队协作做了独特设计，提供了经典的面向对象、动态加载、性能优化解决方案。作为一款全终端支持的 JavaScript 框架，KISSY 为移动终端做了大量适配和优化，让你的程序在全终端均能流畅运行。

# Keep It Simple & Stupid! Yeah!

<div class="row-fluid">
	<div class="col-md-4">
		<h1>跨终端</h1>
		<p>
			作为生长于淘宝/天猫的前端 JavaScript 类库，在全网数以万计全终端的硬件设备中运行测试，KISSY 在我国互联网环境下各色终端、浏览器、移动设备中具备一流的健壮性和兼容性。
		</p>
	</div>
	<div class="col-md-4">
		<h1>模块化</h1>
		<p>
			KISSY 采用高度的模块化设计，通过加载器按需加载。模块高度解耦，并具有极强的扩展性。核心组件完整齐全，接口一致。适合多种应用场景，尤其适用团队协作的大型项目开发。
		</p>
	
	</div>
	<div class="col-md-4">
		<h1>使用简单</h1>
		<p>
			KISSY 核心功能的设计遵循二八原则，保持最常用 API 的精简子集，自动探测终端主动适配，可以非常方便开始你的项目。清晰的面向对象功能以及轻松的架构性，更增强了 KISSY 的易用性。
		</p>
	
	</div>
</div>

# Hello Kissy!

> 学习 KISSY，从这里开始 
> 
> <a class="btn btn-primary btn-lg">Start Up!</a> &nbsp;
> <a class="btn btn-info btn-lg">API Doc</a>

首先，我们来运行一些最简单的例子帮你了解 KISSY<span class="badge">Examples</span>：

**种子**：获取最新的 KISSY 1.4.0 种子文件地址

<div class="alert alert-info">
	<div style="font-size:20px;">http://g.tbcdn.cn/kissy/k/1.4.0/seed-min.js</div>
</div>

**启动**：Hello World!

	KISSY.ready(function(S){
		alert('Hello World!');
	});

**DOM操作**：获取一个className叫`continue`的`button`，并将它的内容改为"Hello Kissy"。

	KISSY.use('node',function(S){
		S.one('button.continue').html('Hello Kissy!');
	});

**事件处理**：点击一个id为`click-me`的`button`，显示`#banner-msg`的内容。

	KISSY.use('node',function(S){
		S.one('#click-me').on('click',function(e){
			S.one('#banner-msg').show();
		});
	});

**Ajax**：请求一个`api/getWeather`的接口，带入参数`zipcode`，将结果显示在`#weather-con`中。

	KISSY.use('io,node',function(S){
		S.io({
			url:'/api/getWeather',
			data:{
				zipcode:10010
			},
			success:function(data){
				S.one('#weather-con').html('<em>' + data + '</em> 摄氏度');
			}
		});
	});

# KISSY 的一些组件

<style>
.img-rounded{
	box-shadow:0 0 8px -3px black;
}
.index-box {
	height:200px;
}
</style>

<div class="row-fluid index-box">
	<div class="col-md-4">
		<div class="caption text-center">
			<h2><a href="#">Waterfall</a></h2>
		</div>
		<img src="http://gtms03.alicdn.com/tps/i3/T1iH9AFiVcXXcKO_TS-300-186.png" class="img-rounded img-responsive">
	</div>
	<div class="col-md-4">
		<div class="caption text-center">
			<h2><a href="">Resizeable</a></h2>
		</div>
		<img src="http://gtms04.alicdn.com/tps/i4/T109qzFXdbXXX_yTTS-300-185.png" class="img-rounded img-responsive">
	</div>
	<div class="col-md-4">
		<div class="caption text-center">
			<h2><a href="http://gallery.kissyui.com/autocomplete/1.2/guide/index.html">Autocomplete</a></h2>
		</div>
		<img src="http://gtms01.alicdn.com/tps/i1/T1YhiwFjFgXXX_yTTS-300-185.png" class="img-rounded img-responsive">
	</div>
</div>
<div class="row-fluid index-box">
	<div class="col-md-4">
		<div class="caption text-center">
			<h2><a href="">Editor</a></h2>
		</div>
		<img src="http://gtms02.alicdn.com/tps/i2/T1fn1AFnpbXXX_yTTS-300-185.png" class="img-rounded img-responsive">
	</div>
	<div class="col-md-4">
		<div class="caption text-center">
			<h2><a href="">Calendar</a></h2>
		</div>
		<img src="http://gtms03.alicdn.com/tps/i3/T1SJqBFX4bXXcKO_TS-300-186.png" class="img-rounded img-responsive">
	</div>
	<div class="col-md-4">
		<div class="caption text-center">
			<h2><a href="http://gallery.kissyui.com/kcharts/1.1/guide/index.html">KChart</a></h2>
		</div>
		<img src="http://gtms04.alicdn.com/tps/i4/T1tG5zFlleXXX_yTTS-300-185.png" class="img-rounded img-responsive">
	</div>
</div>

# 哪些网站在使用 KISSY

所有的淘系对外产品已经在大量使用 KISSY，包括 PC 和 移动端产品。这里是一些典型案例：

<div class="row-fluid index-box">
	<div class="col-md-4">
		<div class="caption text-center">
			<h2><a href="http://www.taobao.com">淘宝网</a></h2>
		</div>
		<img src="http://gtms02.alicdn.com/tps/i2/T1tHOyFdxeXXX_yTTS-300-185.png" alt="..." class="img-rounded img-responsive">
	</div>
	<div class="col-md-4">
		<div class="caption text-center">
			<h2><a href="http://www.tmall.com">天猫</a></h2>
		</div>
		<img src="http://gtms03.alicdn.com/tps/i3/T1.huyFdhfXXX_yTTS-300-185.png" alt="..." class="img-rounded img-responsive">
	</div>
	<div class="col-md-4">
		<div class="caption text-center">
			<h2><a href="http://caipiao.m.taobao.com/lottery/h5/app.html?mode=web#viewpath=index%2Fa.html">淘宝彩票(移动版)</a></h2>
		</div>
		<img src="http://gtms04.alicdn.com/tps/i4/T1gD9xFedfXXcKO_TS-300-186.png" alt="..." class="img-rounded img-responsive">
	</div>
</div>

