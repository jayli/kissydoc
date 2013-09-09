# Seed

> Seed 模块是 KISSY 的核心。必须在所有使用 KISSY 的页面中引入，所有核心模块的依赖关系均在 Seed 中定义，基于它可以生长出你所需要的代码基础库，而无需手写`script`标签。注意：Seed 并不是一个“模块名”，但它包含这些核心模块：lang，uri，features，promise，path，loader，ua。模块名称均小写。

## 载入 seed

	<script src="http://g.tbcdn.cn/kissy/k/1.4.0/seed-min.js"></script>

Seed 是一段很小的脚本，包含模块加载器，用来加载其他核心模块。Seed 会引入全局对象`KISSY`。加载外部模块：

	KISSY.use('node',function(S,Node){
		// Your Code...	
	});

这时浏览器会将`node`模块对应的js文件及其依赖载入进来，载入后会注册`node`模块到 KISSY，之后执行这里的回调，将`node`模块返回的对象带入第二个参数。回调函数第一个参数为KISSY对象的简写。注意这里有两个关键行为：

1. 载入`node`模块对应的外部js文件
2. 注册`node`模块

这是`use()`函数的两个基本功能，这两个基本功能通过`模块名称`统一起来，让他们看其来是一个操作，但不要忘记，实际上有这两层含义。

## 模块

根据上文，模块名有两个层面的含义

1. 指示文件所在的地址
2. 指示模块的具体内容

KISSY 要求所有满足 KMD 规范的模块，首先具备`属性2`，其次具备`属性1`。即`use()`首先要执行已经注册的模块，如果没有注册，则先尝试去模块名所指示的位置加载模块文件，再执行注册和运行。因此，只有被KISSY.add包装起来的代码，才是正确的 KISSY 模块。

### 场景1：运行已经注册的模块
	
	// index.html
	KISSY.add('a',function(S){
		return {};	
	});

	// 这里的use()不会造成一次http请求，因为模块a已经被注册过
	KISSY.use('a',function(S,A){
		// Your Code
	});

### 场景2：运行外部文件注册的模块

	// index.html
	// 这里的use()会先载入'path/to/a.js'(及其依赖)，因为这时模块'path/to/a'没有被注册过
	KISSY.use('path/to/a',function(S,A){
		// A 为模块'path/to/a'的返回对象
		// Your Code
	})

	// path/to/a.js
	// 外部文件中注册了名为'path/to/a'的模块
	KISSY.add('path/to/a',function(S){
		return {};	
	});

### 场景3：注册模块族

可否将很多模块的注册抽离入一个文件？当然可以，比如这个例子，mods.js 包含了很多个模块的注册，预先载入页面后，KISSY 注册了mods.js里的这些模块，这时通过use()调用时，只是运行注册的模块，而不会造成额外的http请求

	// index.html
	<script src="mods.js"></script>
	<script>
		KISSY.use('a,b,c',function(S,A,B,C){
			// Your Code
		});
	</script>

	// mods.js
	KISSY.add('a',function(){});
	KISSY.add('b',function(){});
	KISSY.add('c',function(){});

总之，KISSY.use() 函数的执行，会首先查找模块是否已经注册，若注册过，则直接执行模块逻辑，若没有注册过，则先加载模块名对应的模块文件，再注册并执行。KISSY Seed中包含的模块即可以通过这种方式直接调用，而不会造成额外的http请求。

### 场景4：运行一个没有被注册过的模块（报错）

KISSY.use() 的目的是运行模块并执行回调，载入外部文件只是其附加功能。因此不能使用KISSY.use()来载入任意外部文件。比如：

	// index.html
	// 运行出错，因为'path/to/jquery'没有被注册
	KISSY.use('path/to/jquery',function(S,jQuery){
		// Your Code...	
	});

	// jquery.js
	function(window,undefined){
		// blablabla...
	}();

必须给jquery.js冠以KMD格式：

	// jquery.js
	KISSY.add('path/to/jquery',fucntion(S)){
		// jquery 主体内容
		function(window,undefined){
			// blablabla...
		}();
		return jQuery;
	});

----------------------------

## 模块别名

上文提到，模块名称用一个路径来表示，那么类似`node`这种核心模块，如何对应到具体的文件路径呢？通过 alias 来实现。比如映射之前代码为：

	// index.html
	KISSY.use('path/to/a',function(S,A){
		// use A
	});

	// path/to/a.js
	KISSY.add('path/to/a',function(S){
		return {};
	});

映射之后：

	// index.html
	// 配置映射，a => path/to/a
	KISSY.config('modules',{
		'a':{
			alias:['path/to/a']
		}
	});

	// 使用a
	KISSY.use('a',function(S,A){
		// use A
	});

	// path/to/a.js
	// a.js 的代码无变化
	KISSY.add('path/to/a',function(S){
		return {};
	});

----------------------------

## Seed 中的模块预设

以上为 KISSY 核心模块的实现机理。`seed.js` 类似上文提到的 `mods.js`，是一个注册模块的集合，`seed`并不表示任何一个模块名，因此这个用法是错误的：

	KISSY.use('seed',function(){});

应当这样使用Seed中注册的模块

	KISSY.use('lang,ua',function(S,Lang,UA){
		// Your code...	
	});

### 使用Seed中模块的另外一种偷懒的做法

seed.js 中注册的模块都会给全局KISSY对象挂载快捷调用的通道，比如`Lang.clone()`可以通过`KISSY.clone()`来调用。但这种做法仅限于KISSY核心模块，自定义模块建议严格按照KMD规范来传递参数。
