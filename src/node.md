# node

Node 模块提供了对DOM节点的最高层的封装，可以创建、操作、遍历、查找Dom节点。封装后的Node节点在各个浏览器端均具有一致的API，这些API甚至在NodeList类型上也是可以用的。同时，Node还提供了对CSS、动画、事件的基本的封装。可以让你方便的操作DOM节点。

## 载入Node模块

载入KISSY种子文件后，这样载入Node模块

	// 载入 Node 模块
	KISSY.use('node',function(S,Node){
		// 装载了 Node 模块，并处于可用状态
		// Your Code here...
	});

从这里了解[use()](loader.html)方法。

## 使用Node

Node API 是基于DOM Api 实现的，定义了一系列的语法糖，让用户更舒服的使用Node api，写的代码更加优雅。如果你对标准jQuery DOM API很了解，那么你对Node API也会非常熟悉。

## 查找节点

	// 使用 S.one( [css selector string] )
	var node = S.one('#main');

	// 或者传入一个HtmlElement元素
	var bodyNode = S.one(document.body);

`one()`方法类似于jquery的$，通过传入选择器或者Dom实例来获取目标（包装后）的Node节点。如果传入一个css选择器，`one()`函数将返回第一个匹配的节点。如果要获得节点列表，需要使用`all()`方法。

> 注意：KISSY 在选择器上的实现是渐进增强的，在高级浏览器中优先使用`querySelector`和`getElementsByClassName`等原生函数，在低版本的IE中降级使用`selector/ie`的js实现。对于异类的CSS3特有的选择器，在低版本IE中用sizzle实现。这样做主要是为了精简选择器的实现代码，降低 KISSY 核心代码体积。
>
> KISSY 会根据浏览器平台加载正确的代码，用户不用关心平台，KISSY 一定会调用最合适、性能最优的选择器实现。在1.4.0中，不需要用户手动引用`sizzle`模块了，KISSY 会自行判断加载。

## 操作内容

KISSY Node 节点支持链式调用。[使用范例](http://docs.kissyui.com/docs/html/tutorials/quickstart/node.html)。

	S.one('#test')
		.parent('.fathor')
		.next()
		.html('<p></p>')
		.on('click', function() { /* ... */ });

这种风格和jQuery保持一致。创建节点：

	S.Node('<div>hello kissy</div>').appendTo('body');
	
这里的例子涉及查找子节点、父节点，找兄弟节点，修改内容，绑定事件，创建节点。

## 访问 Node 节点的属性

	var imgNode = S.one('#preview');
	var bigSrc = imgNode.attr('src');//得到imgNode的src属性

	imgNode.attr('src', 'new.png');// 设置src属性为一个新的值
	imgNode.next().html('hello world');// 设置imgNode下一个兄弟节点的innerHTML

Node 实例通过`attr`方法来读写常见的属性。一些className和innerHTML相关的常用操作，被封装为addClass、replaceClass或者html方法。更多用法请参照下文API部分。

## Node 事件操作

	S.one('#demo').on('click', function(e) {
		e.halt();
		alert('event: ' + e.type + ' target: ' + e.target.tagName); 
	});

回调传回一个门面对象`e`，e是原生事件对象，是非封装后的，这时`e.target`是裸的节点。除了preventDefault()和stopPropagation()之外，e还包含halt()方法，停止事件加阻止默认行为。

## Node 方法

Node 实例实现了一些快捷方法，用来方便用户更快捷的操作DOM节点。比如append、next、appendTo、addClass等等。

## NodeList  集合

	var doneTasks = S.all('#tasklist .completed');

	// 针对所有的节点进行操作
	doneTasks.removeClass('highlight');

	// 调用each()方法来遍历这些节点
	doneTasks.each(function (taskNode,k) {
		taskNode.html('这是第'+k+'个节点');
	});

查找节点集合最简单的办法即使用`S.all`，DOM 操作方法中，KISSY库会尽可能的返回节点集合，而非节点。通过`nodeList[i]`来获取第`i`个节点（从0开始计算）。

节点集合暴露each()方法，方便我们对节点集合进行遍历。对一个Nodelist执行attr方法，将返回第一个节点的属性值。

Node 实例支持逐级查找`S.all('.s1').all('.s2')`和`S.all('.s1 .s2')`是等价的。

> `S.all('.s1').all('.s2')`和`S.all('.s1 .s2')`毕竟还是不同的，在一个多次遍历的场景中，无报错的情况下，通常第一个用法速度优于第二个，因为S.one始终从document根节点开始查找。

KISSY 支持几乎所有的CSS3选择器。CSS3选择器种类如下：

- [CSS 3 选择器](http://www.w3.org/TR/css3-selectors/)
- [选择器 API](http://www.w3.org/TR/selectors-API/)

## 无障碍支持

KISSY 支持标准的[ARIA](http://www.w3.org/TR/wai-aria/)。即 KISSY 可以完整的支持无障碍特性。比如对[roles](http://www.w3.org/TR/wai-aria/#roles)和[state](http://www.w3.org/TR/wai-aria/#supportedState)的支持。这些特性可以和读屏软件很好的兼容，在增强html标签语义化的同时，让盲人用户使用页面更加顺畅。

	// 写一个属性
	var node = S.one('#toolbar').attr('role', 'toolbar');
	// 同时写多个属性
	node.attr({
		role: 'menu', 'aria-hidden': true 
	});

------------------------------------

# Node或NodeList 的实例方法

### all()，one() 

	S.one('.filter'); // 从document根节点开始查找一个节点
	S.all('.filter'); // 从document根节点开始查找一批节点
	node.one('.child'); // 得到当前节点下的匹配选择器的一个节点
	node.all('.children'); // 得到当前节点下的匹配选择器的节点列表

### getDOMNode()，getDOMNodes()

	node.getDOMNode();// 得到一个原生节点
	node.getDOMNodes();// 得到一个原生节点组成的数组

### end()

得到上一次 one() 和 all() 操作前的 NodeList 或者 Node 对象。引入该方法是为了更好的支持链式操作( chaining )，可以在一个语句内对不同层次得节点集合进行不同的操作.[demo](http://docs.kissyui.com/source/raw/api/core/node/end.html)。

	S.one("body").all(".d1").css("color", "red");// => 返回节点.d1
	S.one("body").all(".d1").css("color", "red").end();// => 返回节点 body
	S.one("body").all(".d1").css("color", "red")
		.end()
		.all('.d2');// => 返回节点 .d2 

### equals()

判断节点是否相等

	<div class='a b' id='a'></div>
	<div class='a b' id='b'></div>
	<script>
		KISSY.all(".a").equals(KISSY.all(".b")) // => true
	</script>

### add()

将多个Nodelist/Node对象合并为一个集合返回，原有对象不会变化，参数和all保持一致

	<p>1</p><div>2</div>
	<script>
		var pdiv = S.all("p");
		var all= pdiv.add("div");  //  pdiv 不会变化
		all.css("color","red"); // => 1,2 都为红字
	</script>

### item()

返回NodeList的某个下标表示的节点，得到的是封装后的Node节点，而非原生节点，得到原生节点直接用数组下标获取`S.all('.a')[0]`

	<div class='a' id='a'></div>
	<div class='a' id='b'></div>
	<script>
		// 取第0个节点
		S.all(".a").item(0).attr("id")  // => a
		// 取第一个节点
		S.all(".a").item(1).attr("id")  // => b
		// 取第二个节点
		S.all(".a").item(2)  // => null
	</script>

### slice()

获取包含当前节点列表选定范围内原生节点的新 NodeList 对象

	var as = S.all(".a");
	var subs = as.slice(1,3); // => subs != as
	subs.length // => 2，subs 为被截取之后的节点 

### scrollTop()

返回节点滚动条的垂直位置.[demo](http://docs.kissyui.com/source/raw/api/core/node/scrollTop-get.html)

	var p = S.all("p:first").scrollTop();
	alert(p);// 返回第一个p元素的滚动条高度

设置当前节点的滚动条的高度

	S.one('.filter').scrollTop(100);// 设置元素.filter的滚动条高度为100

一般这样获取页面的滚动条高度

	KISSY.one(document).scrollTop();
	KISSY.DOM.scrollTop();// 这两者完全一致

### scrollLeft()，用法同scrollTop()

### height() 和 width()

获得节点的计算高度或宽度，css('height') 和 height() 的区别在于 height() 返回不带单位的纯数值, 而 css('height') 则返回带单位的原始值(例如 40% ).

![](http://docs.kissyui.com/source/raw/api/core/node/height.png)

该方法也可以用来得到 windw 和 document 的高度

	S.all(window).height(); // 得到浏览器可以区域的高度, 相当于 DOM.viewportHeight()
    S.all(document).height(); //得到 html 文档的高度, 相当于 DOM.docHeight()

> 在现代浏览器中, css height 属性不包括 padding , border 或者 margin.

设置元素的高度或宽度

	S.all('.filter').height(100);// 设置一组元素的高度为100px
	S.all('.filter').height('100px');// 设置一组元素的高度为100px
	S.all('.filter').height('20em');// 设置一组元素的高度为20em

- [得到各种各样高度的demo](http://docs.kissyui.com/source/raw/api/core/node/height-get.html)
- [设置元素高度的demo](http://docs.kissyui.com/source/raw/api/core/node/height-set.html)

### addStyleSheet()

添加样式表

	node.addStyleSheet('xx {_width:xx;}');// 可以写css hack

另外一种加样式的方法：

	var styleEl = S.all("<style>p {color:red}</style>").appendTo("head");

### append()

将参数内容插入到当前节点列表中的每个元素的末尾.

	<h2>Greetings</h2>
	<div class="container">
	  <div class="inner">Hello</div>
	  <div class="inner">Goodbye</div>
	</div>
	<script>
	KISSY.use("node",function(S,Node){
		Node.all('.inner').append('<p>Test</p>');
	});
	</script>

操作之后的结果为：

	<h2>Greetings</h2>
	<div class="container">
	  <div class="inner">
		Hello
		<p>Test</p>
	  </div>
	  <div class="inner">
		Goodbye
		<p>Test</p>
	  </div>
	</div>

把页面上已有的元素 prepend 到另外一个:

	S.all('.container').append(S.all('h2'));

如果当前节点列表只包括一个节点, 那么他将会被移到目标容器中(而不是克隆):

- [在所有段落中添加一些 html 字符串demo](http://docs.kissyui.com/source/raw/api/core/node/append-1.html)
- [给所有段落添加一个文本节点](http://docs.kissyui.com/source/raw/api/core/node/append-2.html)
- [给所有段落添加一个 `NodeList` 对象](http://docs.kissyui.com/source/raw/api/core/node/append-3.html)

### appendTo()

将当前节点列表中的每个元素插入到容器列表的每个元素的最后一个子节点后面.

我们可以创建元素后立即插入到多个已有元素:

	S.all('<p>Test</p>').appendTo('.inner');

也可以把一个已有元素插入到另一个

	S.all('h2').appendTo(S.all('.container'));

如果容器列表只有一个节点, 那么当前节点列表会被移动到容器内(不是克隆):

- [把多个 span 插入到已有元素](http://docs.kissyui.com/source/raw/api/core/node/appendTo.html)

### prepend()

用法同append()，prepend()表示插入到最前

### prependTo()

用法同prependTo()，prependTo()表示插入到最前

### insertBefore()

在某个节点之前插入节点

	S.all('<p>Test</p>').insertBefore('.inner');

也可以操作现有元素

	S.all('h2').insertBefore(S.all('.container'));

如果目标节点只有一个, 那么当前节点就会移动到目标节点之前。

- [把段落插入到 div 节点之前Demo](http://docs.kissyui.com/source/raw/api/core/node/insertBefore.html)

### before()

和insertBefore()方法的功能一样, 只不过参数意义不同, insertBefore 表示当前节点列表被插入到参数目标节点之前, 而该方法则表示参数节点被插入到当前节点之前.

- [Demo](http://docs.kissyui.com/source/raw/api/core/node/before.html)

### insertAfter()

用法类似于insertBefore()

### after()

用法类似于before()

### animate()

对当前节点(列表)上做动画，返回一个NodeList实例。

	var node=KISSY.all(".foo");
	node.animate({
		width:100,
		height:300
	}, {
		duration: 2000,
		easing:'easeBoth' ,
		complete: function () {
		}
	});

等价于

	KISSY.all(".foo").each(function(n){
		new KISSY.Anim(n,...).run();
	});

参数请参照[Anim](anim.html)。

### stop()

停止当前动画，同`Anim.stop()`。

### pause()

停止当前节点列表的动画，同`Anim.pause()`

### resume()

继续当前节点的动画，含义同`Anim.resume()`

### isRunning()

判断当前节点是否在做动画的过程中

### isPaused()

判断当前节点是否已经暂停动画

### show()

显示当前节点

	node.show();// 直接显示
	node.show(0.5,function(){
		// 0.5 秒后执行这里的回调	
	});

### hide()

隐藏节点

	node.hide();// 直接隐藏
	node.hide(0.5,function(){
		// 0.5 秒后执行这里的回调	
	});
	
### toggle()

更改节点的隐藏和显示状态

	node.toggle();// 直接切换显示状态
	node.toggle(0.5,function(){
		// 0.5 秒后执行这里的回调	
	});

### fadeIn()

当前节点以渐隐效果显示

	node.fadeIn(1,function(){
		// 1 秒后执行回调	
	},easeIng);
	// easyIng 取值请参照Anim

### fadeOut()

当前节点渐隐效果消逝，用法同fadeIn()

### fadeToggle()

当前节点渐隐效果切换显示状态

### slideDown()

当前节点从上到下滑动显示，参数同fadeIn()

### slideUp()

当前节点从下到上活动显示，参数同fadeIn()

### slideToggle()

当前节点上下滑动切换显示状态，参数同fadeIn()

### filter()

对于NOdeList过滤出符合条件的节点，返回NodeList

	KISSY.use('node',function(S,Node)){
		var els = S.all('a').filter('.container');
		// 过滤出className为container的a标签
	});

### test()

根据选择器获取的所有元素是否都符合过滤条件

	var els = S.all('a');
	console.log(els.test('.container'));//a标签是否都包含class名container

### clone()

节点的深度克隆，用法：`node.clone(deep,withDataAndEvent,deepWithDataAndEvent)`

参数默认值：

- deep:false
- withDataAndEvent:false
- deepWithDataAndEvent:false

比如这段代码

	<div class="container">
		<div class="hello">Hello</div>
		<div class="goodbye">Goodbye</div>
	</div>

如果将页面中已经存在的节点插入到其他位置，它会从原来的位置移除，类似：

	KISSY.one('.hello').appendTo('.goodbye');

DOM 结构变为：

	<div class="container">
		<div class="goodbye">
			Goodbye
			<div class="hello">Hello</div>
		</div>
	</div>

为了阻止原来的元素移动，而插入一个元素的复制版本，那么你可以这样写

	KISSY.one('.hello').clone(true).appendTo('.goodbye');

这样DOM结果为：

	<div class="container">
		<div class="hello">Hello</div>
			<div class="goodbye">
			Goodbye
			<div class="hello">Hello</div>
			<div class="hello">Hello</div>
		</div>
	</div>

默认情况下 clone 后的元素不会具备源元素的 data 属性以及事件绑定，但是如果你设置了 `withDataAndEvent=true` , 那么 clone 后的元素也会具备源元素的 data 属性以及事件绑定。

	node.clone(true,true);

更进一步的你可以设置 deepWithDataAndEvent 来使得 clone 后元素的子孙元素也具备源元素对应子孙元素的 data 属性和事件绑定.注意这时 deep 参数也要设置为 true.

	node.clone(true,true,true);

源元素的对象以及数组类型的 data 属性只是引用被复制到 clone 后的元素，他们的值则会在源元素以及克隆元素间共享，如果想进行 deep copy，请手动进行

	var elem=KISSY.one(".hello").attr("custom",{x:1});
	elem.clone().attr("custom",{x:2});

[克隆后保留原有事件逻辑Demo](http://docs.kissyui.com/source/raw/api/core/dom/clone.html)

