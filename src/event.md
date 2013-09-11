# event

Event 模块是KISSY最重要的模块之一，他包含自定义事件机制、事件对象封装、DOM事件封装、面向多终端的事件行为统一。下辖多个子模块，被Node、DOM、Base分别依赖。通常DOM事件无需直接引用event，只需use('node')即可。使用use('base')时也无需手动引入event。如果想单独使用自定义事件，则需要use('event')。

	KISSY.use('event',function(S,Event){
		// Your code..	
	});

Event是一个复杂的概念，是观察者模式在浏览器端的实现。事件本质上是一个抽象的概念。是让程序具有面向切面编程的特性，通过事件注册来在原有逻辑的某个时机触发外部代码的逻辑。这种方式是最常见的JavaScript设计模式。也是模块之间解耦的最佳选择之一。

## Node 事件

### 事件绑定

浏览器对DOM节点暴露了一些事件，比如常见的click、mouseover等。在KISSY中通过统一的事件绑定写法来处理事件回调：

	Event.on('#foo','click',function(){
		// 其中this是原生节点
		alert('clicked : '+this.id);
		return false;
	});

上面的代码作用是：为 id 为 foo 的元素绑定 click 事件.当用户在该元素内部点击时, 则 alert 会弹出来.

回调函数返回 false 相当于调用了事件对象的 preventDefault() 以及 stopPropagation()

Node 模块的 on 方法中的 this 关键字指向当前绑定事件的单个原生节点, 事件对象的 target 和 relatedTarget 也指向对应的原生节点,

	<div id='d1' class='d'></div>
	<div id='d2' class='d'></div>

	<script>
		KISSY.all(".d").on("mouseenter",function(ev){
			this.id // => d1 或者 d2
			ev.target.id // => d1 或者 d2
			ev.relatedTarget // => d1 或者 d2 或者 document.body
							// 或者 document.documentElement
		});
	</script>

为了保持应用兼容，推荐的做法是，在回调函数开始包装 this （需要的话同样包装 event.target）

	<div id='d1' class='d'></div>
	<div id='d2' class='d'></div>

	<script>
		KISSY.all(".d").on("mouseenter",function(ev){
			var self=KISSY.one(this);
			self.attr("id") // => d1 或者 d2
		});
	</script>

### 事件分组

on()函数支持事件分组，比如这段代码：

	Event.on('#foo','click.one',function(){
		alert('clicked : '+this.id);
	});

	Event.on('#foo','click.two',function(){
		alert('clicked 2 : '+this.id);
	});

	Event.remove('#foo','.two');

给`#foo`绑定了两次事件，但每次事件都有一个标识，这时可以清除其中一个标识。

### 绑定多个事件

	// 绑定了两个事件
	Event.on('#foo','mouseenter mouseleave', function(e) {
		DOM.toggleClass(this,"enter");
	});

上述代码的作用是：一开始 foo 节点没有 enter 样式类, 当鼠标进入时给该节点添加 enter 样式类, 当鼠标移出时把 enter 样式类去掉. 这样就达到了 hover 的效果.

### 事件对象

DOM 事件回调函数回传参数为e，被称为事件对象，这里的事件对象是浏览器原生的对象。

	Event.on('#foo','mouseup mousedown', function(event) {
		console.log(event.type +" occured");
	});

这样就可以在绑定多事件时, 明确知道当前哪个事件触发了.

> KISSY 也对 mouseenter/mouseleave focusin/focusout 进行了兼容处理, 所有浏览器都可以使用这两个事件了.

处理段落的单击与双击例子。注意坐标是相对于例子的 iframe 窗口的, 这里方便起见采用node。[参照Demo](http://docs.kissyui.com/source/raw/api/core/event/on_1.html)。

通过调用事件对象的halt()方法来阻止事件。 

	Event.on('a','click',function(e){
		// 等价于 e.preventDefault(); e.stopPropagation();
		e.halt();
	});

如果要抓取事件发生时对应的节点，需要通过`e.target`获取，注意，这里的targe是原生节点，若有必要，需要转换为Node节点，比如

	Event.on('a','click',function(e){
		var node = S.one(e.target);
		alert(node.html());
	});

### 事件移除

从符合匹配的 dom 节点中移去相应事件的事件处理器，用 on 绑定的事件处理器可以用 detach 解除绑定. 最简单的情况 detach(elem) 解除该元素上的所有绑定.

	Event.detach('#foo');

上面的代码解除了 foo 元素上所有事件的事件处理器, 我们也可以解除某一个事件的全部事件处理器:

	Event.detach('#foo','click');

当时如果程序对同一事件指定了不同的事件处理器, 这时就需要后面两个参数了

	var handler = function() {
		alert('The quick brown fox jumps over the lazy dog.');
	};
	Event.on('#foo','click', handler);
	Event.detach('#foo','click', handler);

通过指定第三个参数, 我们可以保证该事件的其他事件处理器不受影响, 注意下面的代码则不会生效：

	var handler = function() {
		alert('The quick brown fox jumps over the lazy dog.');
	};
	var obj={x:1};
	Event.on('#foo','click', handler,obj);

	Event.detach('#foo','click', function() {
		alert('The quick brown fox jumps over the lazy dog.');
	},obj);

	Event.detach('#foo','click', handler,{x:1});

虽然后面的两个 detach 参数从字面上来看完全一样, 但是由于是不同的对象, 所有仍然不会生效. 如果需要解除特定的事件处理器, 我们需要同一个对象( 函数 )引用, 而不是恰好字面上相同的不同对象.

detach也可以用别名remove标识。[事件移除的Demo](http://docs.kissyui.com/source/raw/api/core/event/detach_1.html)。

> 如果要解除特定的事件处理器 , detach 的参数必须和对应的 on 参数值相等( == )并且个数一致才能完成解除绑定的目标.

### 事件委托

为符合匹配的 dom 节点的相应事件添加事件处理器, 并在该节点的子孙节点中匹配 filter 的节点上触发事件时调用.

该方法是 on 方法的增强. 当 on 方法被调用时, 符合选择器的元素被绑定事件处理器, 但如果新增符合要求的节点，就不会再触发事件, 即他们需要另外一次绑定, 例如

	<body>
		<div class="clickme">
			Click here
		</div>
	</body>

绑定一个 click 事件的事件触发器：

	Event.on('.clickme','click', function() {
		// Your code..
	});

当该元素被点击时, 调用对应的事件处理器. 但是如果新加入一个元素：

	Node.one('body').append('<div class="clickme">Another target</div>');

新元素匹配选择器 clickme ,但是他如果不再次 on , 则在他上面的点击不会有任何效果.

delegate 方法提供了解决方法, 如果这样调用：

	Event.delegate(document,'click','.clickme',function(){
		// Your code..
	});

这样，只要是在document内新增的节点，都会触发回调。可以使用 undelegate 来移除之前的绑定:

	function d(){
	}

	// 绑定
	Event.delegate(document,'click','.clickme',d);

	// 解除绑定
	Event.undelegate(document,'click','.clickme',d);

> 不能在 object , embed , applet 元素上注册事件. 事件处理器回调函数中 this 指向 scope (没指定指向绑定事件的元素), 传入的参数为 event , event.target 指向事件触发源, event.currentTarget 指向当前事件处理器调用所在的匹配 filter 的元素. 可以使用 stopPropagation() 来停止事件的向上冒泡, 这样就不会在同样符合 filter 条件的祖先节点上调用事件处理器.
>
> 因为 delegate 是在事件冒泡到代理元素后才开始处理的，那么通过 on 注册到代理元素的子节点的事件处理器已经被触发， 而无法被 delegate 绑定的事件处理器阻止 ( stopPropagation )，但 delegate 事件处理器可以阻止绑定到同一元素但是匹配元素在当前事件处理器之上的 delegate 事件处理器.
>
> 同样可以对 mouseenter , mouseleave 进行委托.

- [事件委托的Demo](http://docs.kissyui.com/source/raw/api/core/event/delegate.html)
- [阻止事件冒泡](http://docs.kissyui.com/source/raw/api/core/event/delegate_2.html)
- [委托 mouseenter/mouseleave](http://docs.kissyui.com/source/raw/api/core/event/delegate_mouse.html)

### 解除事件委托

为符合匹配的 dom 节点的相应事件去除事件处理器

	function d(){}

	// 解除委托
	Event.undelegate(document,'click','.clickme',d);

和 Event.detach 一样, 如果移除特定的委托事件处理器必须保证参数和调用 delegate 时保持一致

### 特殊事件支持

KISSY 对常见的DOM事件做了封装，包括原生浏览器不支持的事件。

- focusin
- focusout
- hashchange
- valuechange
- mouseenter
- mouseleave
- mousewheel

#### focusin

原生只有 ie 支持 focusin 事件，而 kissy 对这一事件进行了 兼容性处理。但一个元素获得焦点或者其子孙元素获得焦点时， focusin 会在该元素上触发（没被子孙元素阻止）。这就是和 focus 事件的区别之处 : 你可以在父元素上监控子元素的 focus 事件，即 focusin 事件支持冒泡.

这个事件常常和 focusout 一起使用. [Demo](http://docs.kissyui.com/source/raw/api/core/event/focusin.html)

#### fousout

原生只有 ie 支持 focusout 事件，而 kissy 对这一事件进行了 兼容性处理 .但一个元素获得焦点或者其子孙元素获得焦点时， focusout 会在该元素上触发（没被子孙元素阻止）。这就是和 blur 事件的区别之处 : 你可以在父元素上监控子元素的 blur 事件，即 focusout 事件支持冒泡.

[focusout事件的demo](http://docs.kissyui.com/source/raw/api/core/event/focusout.html).

#### hashchange

目前除了 ie67 外都原生支持 hashchange 事件，kissy 对 ie67 也模拟兼容了该事件.当浏览器的 hash 值发生变化时会触发此事件，常常被用来实现单页面应用，因为当用户点击后退与前进进行浏览器导航时会引起 hash 变化.

此事件只能在当前 window 上注册，注册到其他类型元素上无效！ `hash` 值推荐为 `!/xx/` 形式, 前面用 `!/` 后面用 `/` 包起来，否则 ie67 可能有诡异现象.

	var $=KISSY.all;
	$(window).on("hashchange",function(){
		// location.hash -> 当前 hash 值
	});

[Demo](http://docs.kissyui.com/source/raw/api/core/event/hashchange.html)。

### valuechange

监控 input/textarea 的值变化，当值发生变化时在绑定元素上触发该事件。为什么不使用原生的 change keydown keyup

- change 只有在输入框失去焦点时触发.
- keyup/down 对于国际语言的输入法不能全面支持（鼠标从输入法中选词）
- keydown/up 需要过滤不可见字符
- 程序设值不可以触发原生事件
- 从浏览器自带的 input 自动提示列表中鼠标选择项，不会触发 keydown keyup，但 input 值变化
- 右键鼠标黏贴不能支持

当输入框获得焦点，程序动态设值可触发 valuechange 事件，否则不触发该事件.

事件对象上会挂两个值

- prevVal，旧值 
- newVal，新值

此事件只能在 input 以及 textarea 上注册，注册到其他类型元素上无效！

	KISSY.Event.on(input,"valuechange",function(e){
		alert(e.prevVal); // => 旧值
		alert(e.newVal); // => 新值
	});

[Demo](http://docs.kissyui.com/source/raw/api/core/event/valuechange.html)

#### mousewheel

对鼠标滚轮事件做了浏览器兼容性处理，[Demo](http://docs.kissyui.com/source/raw/api/core/event/mousewheel.html)



