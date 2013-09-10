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

Node 实例通过`attr`方法来读写常见的属性。一些className和innerHTML相关的常用操作，被封装为addClass、replaceClass或者html方法。

## Node 事件操作

	S.one('#demo').on('click', function(e) {
		e.halt();
		alert('event: ' + e.type + ' target: ' + e.target.tagName); 
	});

回调传回一个门面对象`e`，e是原生事件对象，是非封装后的，这时`e.target`是裸的节点。除了preventDefault()和stopPropagation()之外，e还包含halt()方法，停止事件加阻止默认行为。

## Node 方法

Node 实例实现了一些快捷方法，用来方便用户更快捷的操作DOM节点。比如append、next、appendTo、addClass等等。

## Node 集合

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


