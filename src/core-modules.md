# KISSY 的文件结构

## KISSY 架构

### 核心模块划分

![](http://gtms03.alicdn.com/tps/i3/T1vwyBFihXXXbzxlgn-531-626.png)

- **Seed**：KISSY 种子文件，包含基础的面向对象支持、模块加载器、Lang 增强、UA，所有 KISSY 应用必须载入种子文件。种子不包含 DOM、Node 等常用功能，需要开发者按需引入。
- **Components**：颗粒化的功能单元，是比较常用的模块，二八原则中的那20%，这些是官方提供的可靠的模块。
- **Widgets**：组件，分为官方提供和非官方提供。非官方组件由第三方开发，存储于 Gallery 内，官方组件和 Components 组件一样，直接`KISSY.use('modName')`来载入。

> 从 KISSY 1.4.0 开始，将不再提供`kissy.js`，只提供`seed.js`，目的是强制用户按需加载，避免无用组件的载入，尽可能的减少请求的体积。因此，开发者需要熟练掌握核心组件的使用，尤其是图中加粗的部分。

Seed 和 Components 模块说明：

<table class="table table-bordered table-condensed">
<thead>
	<tr>
		<th>
			模块名称
		</th>
		<th>
			模块描述
		</th>
	</tr>
</thead>
<tbody>
	<tr class="success">
		<td>
			<strong>seed</strong>
		</td>
		<td>
			引入种子后会包含这些核心组件：loader/features/path/ua/promise/uri/lang
		</td>
	</tr>
	<tr>
		<td>
			io
		</td>
		<td>
			Ajax 模块，包括 JSONP、抓取远程脚本等
		</td>
	</tr>
	<tr>
		<td>
			dom
		</td>
		<td>
			元素操作相关
		</td>
	</tr>
	<tr>
		<td>
			event
		</td>
		<td>
			事件
		</td>
	</tr>
	<tr>
		<td>
			base
		</td>
		<td>
			经典的面向对象实现，包含Attr、EventHost、Plugin等
		</td>
	</tr>
	<tr>
		<td>
			anim
		</td>
		<td>
			动画
		</td>
	</tr>
	<tr>
		<td>
			json
		</td>
		<td>
			json 解析和反解析
		</td>
	</tr>
	<tr>
		<td>
			kison
		</td>
		<td>
			KISSY 对象格式
		</td>
	</tr>
	<tr>
		<td>
			cookie
		</td>
		<td>
			cookie 读写
		</td>
	</tr>
	<tr>
		<td>
			color
		</td>
		<td>
			颜色格式
		</td>
	</tr>
	<tr>
		<td>
			dd
		</td>
		<td>
			拖拽，drag and drop
		</td>
	</tr>
	<tr>
		<td>
			overlay
		</td>
		<td>
			浮层展示
		</td>
	</tr>
	<tr>
		<td>
			resizable
		</td>
		<td>
			放大缩小功能
		</td>
	</tr>
	<tr>
		<td>
			xtemplate
		</td>
		<td>
			模板引擎
		</td>
	</tr>
	<tr>
		<td>
			import-style
		</td>
		<td>
			css loader
		</td>
	</tr>
	<tr>
		<td>
			html-parser
		</td>
		<td>
			HTML 解析器
		</td>
	</tr>
</tbody>
</table>

### DOM/Event 选择性载入子模块

根据硬件环境的不同，KISSY 会选择性加载所需模块，比如`dom/ie`模块，显然不是为了 Mobile 准备的，再比如`event/shake`模块，显然在 Mobile 设备中也不会载入，再比如 IE<9 下会补充加载`event/hashchange`。即，dom 和 event 模块是和环境强相关，**作为开发者，不必去关心这些模块什么情况下怎么载入**，只需了解 KISSY 已经为你处理好了硬件探测，一定会加载正确的最小模块集合。

![](http://gtms03.alicdn.com/tps/i3/T1uuWxFdNfXXbymbv1-273-231.png)

> KISSY 这种处理兼容性的方式为 [shim](http://www.hongkiat.com/blog/html5-shiv-polyfills/)。在涉及到处理浏览器在实现标准 API 上的差异性时，这种方法又被称为 [polyfills](https://github.com/Modernizr/Modernizr/wiki/HTML5-Cross-Browser-Polyfills)。是一种流行的特性检测的方法。

### 通过命名空间来引用模块

KISSY 的模块设计依赖于命名空间，**官方模块只需通过名称来引用**即可，比如

	// 加载 node、io、editor
	KISSY.use('node, io, editor',function(S,Node,IO,Editor){
		// Your Code...	
	});

非官方模块推荐使用`包名+模块名`来引用，比如

	// 引用 Gallery 中的组件
	KISSY.use('gallery/slide/1.1/index',function(S,Slide){
		// Your Code...	
	});

在引用这种非官方模块之前，需要首先定义**包**，形如：

	KISSY.config({
		packages:[
			{
				name:"gallery",
				path:'http://a.tbcdn.cn/s/kissy/gallery',
				ignorePackageNameInUri:true
			}
		]
	});

在引用包+模块时，对应关系如下，其中蓝色部分为包路径，黄色部分为模块的相对路径：

![](http://gtms01.alicdn.com/tps/i1/T1iJmAFfdbXXcIu7D9-488-187.png)

> `gallery`的包名配置已经内置在`seed.js`中，因此当你引用 gallery 里的组件时，不用再人肉**定义包**了。此外包名必须手动配置添加，方法参照 loader。

## 官方模块的自动 Combo

由于 KISSY 的模块非常颗粒化，会不会页面中载入的 JavaScript 文件过多，导致 HTTP 请求数太多呢？有两种方法来减少请求数：

- CDN 动态合并（Combo）
- 静态编译，本地合并

这里只介绍动态合并，前提是你的 CDN 支持 Combo 功能，比如`KISSY.use('node')`会带来13个请求：

![](http://gtms02.alicdn.com/tps/i2/T1IuezFfBdXXaC5N70-657-280.png)

要想开启动态Combo，在全局配置中增加一项`开启动态合并`：

	KISSY.config('combine',true);

或者这样开启：

	<script src="seed-min.js" data-config="{combine:true}"></script>

页面额外请求数变为1个：

![](http://gtms03.alicdn.com/tps/i3/T12iCAFmlaXXa2La3m-575-80.png)

Combo 后的链接为：

	http://g.tbcdn.cn/kissy/k/1.4.0/??node-min.js,dom/base-min.js,event/dom/base-min.js,event/base-min.js,event/dom/shake-min.js,event/dom/focusin-min.js,anim-min.js,anim/base-min.js,event/custom-min.js,anim/timer-min.js,event-min.js,anim/transition-min.js

