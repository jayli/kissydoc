# xtemplate

富逻辑的 KISSY 模板引擎，和[Mustache](http://mustache.github.io/)以及[juicer](http://juicer.name/)类似，Xtemplate 面向更复杂的业务逻辑场景，同时保持高性能和丰富的配置方法，是易学易懂的模板语言。

一个典型的XTemplate模板实例：

	Hello {{name}}
	You have just won ${{value}}!
	{{#if data}}
		{{#each data}}
			{{name}}-{{xindex}}/{{xcount}}
		{{/each}}
	{{/if}}

对应要填充的JSON：

	{
		name:'Kissy',
		value:'10000',
		data:[
			{name:1},
			{name:2}
		]
	}

拼装结果：

	Hello Kissy You have just won $10000! 1-0/2 2-1/2 

XTemplate 可以放置于HTML、配置文件、程序代码中，核心机制就是把模板中的标签替换为JSON对象给定的值，并同时具有一定的模板语言逻辑。模板中除了提供最简单的变量替换，还提供if、else和foreach等常见功能。所谓标签，指的是双花括号包含的一个标记，`{{name}}`就是一个标签，`{{#name}}`也是一个标签。XTemplate模板语言是抽象的，可以有多种编程语言的实现，KISSY 的`xtemplate`模块实现了 XTemplate 标记语言。

这样来引入xtemplate模块：

	KISSY.use('xtemplate',function(S,XTemplate){
		// use XTemplate
	});

如何通过KISSY来解析XTemplate模板？先看一个简单的例子，实现变量替换：

	KISSY.use('xtemplate', function (S, XTemplate) {

		var tpl = 'this is {{title}}!';

		var data = {
			title: 'o'
		};
		var render = new XTemplate(tpl).render(data);

		alert(render);// => "this is o!"
	});

更多例子：[KISSY XTemplate Demos](http://docs.kissyui.com/docs/html/demo/component/xtemplate/index.html)

----------------------------------

## KISSY XTemplate 语法

### `{{key}}`变量替换

使用`{{key}}`输出变量值，`key`表示要替换的JSON中的key，替换为JSON中key对应的value。比如XTemplate：

	this is {{title}}!

要填充的JSON对象：
	
	{
		title:'Kissy'
	}

拼装结果为：

	this is Kissy!

### `{{if condition}}`条件语句

使用`{{if condition}}`来实现条件判断，`condition`表示要判断的值，判断是否存在、为空、是否为falsy。比如模板为：

	{{#if title}}
		has title
	{{/if}}
	{{@if title2}}
		has title2
	{{else}}
		not has title2
	{{/if}}

要填充的JSON对象：

	{
		title:'kissy',
		title2:''
	}

填充结果为：

	has title 
	not has title2 

其中`{{#if}}`和`{{@if}}`完全等价，在某些环境中（比如velocity）里`#`有特殊语义，这时可以用`@`作为`if`前缀。

此外，`title`的取值不为这些值时被认为是真值：`0`，`null`，`''`，`false`，`NaN`，`undefined`。当取值为空数组`[]`或空对象'{}'时，则认为是真值。

### `{{^if condition}}`条件非语句

使用`{{^if condition}}`来实现条件非，如果`condition`值为空或者假值（`0`， `null`， `''`， `false`， `NaN`， `undefined`），则此语句为 true。如果`condition`有值且是真值，语句为 false。比如这段 XTemplate 模板：

	{{^if title}}
		do not has title
	{{/if}}
	{{^if title2}}
		do not has title2
	{{else}}
		has title2
	{{/if}}

填充的JSON为：

	{
		title:undefined,
		title2:''
	}

填充结果为：

	do not has title 
	do not has title2 

### `{{#each}}`循环语句

#### 循环对象数组

使用`{{#each data}}`表示循环，`data`表示循环的对象，数组类型，每个item为一个对象，比如这段 XTemplate：

	{{#each data}}
		{{name}}-{{xindex}}/{{xcount}}
	{{/each}}

如果填充的JSON为数组类型：

	{
		data:[
			{name:1},
			{name:2}
		]
	}

渲染结果为：

	1-0/2
	2-1/2

这时循环内的`{{xindex}}`表示循环的索引值，`{{xcount}}`表示循环的总次数，`{{name}}`是数组中每个对象的属性`name`，替换为属性的值

#### 循环单数组

循环的`data`为数组类型，每个item为一个值，而非对象，比如这段XTemplate：

	{{#each data}}
		{{this}}-{{xindex}}/{{xcount}}
	{{/each}}

要填充的JSON对象为：

	{
		data:['jayli','yiminghe']
	}

渲染结果为：

	jayli-0/2
	yiminghe-1/2

其中循环内的`{{this}}`表示当前循环的item值，`{{xindex}}`和`{{xcount}}`含义同上

#### each中数据层次相对位置的访问

循环体内可以获取JSON对象上的其他属性，同过相对位置写法获得，比如这段XTemplate：

	{{#each data}}
		{{this}}-{{../total}}
	{{/each}}

要填充的JSON对象为：

	{
		data: [1, 2],
		total: 3
	}

填充结果为：

	1-3
	2-3

其中，`{{../total}}`表示从循环体内跳出到`data`属性所在的层级，去查找`data`属性的兄弟属性`total`的值。

-------------------------------------------------------

## KISSY XTemplate 附加功能，只在 JavaScript 的实现中可用

### 函数模板

支持 JavaScript 函数作为模板，XTemplate模板为：

	var tpl = function (scopes) {
		return 'this is ' + scopes[0].title + '!';
	};

对应的JSON如下

	var data = {
		title:'kissy'
	};

拼装结果为：

	this is kissy!

完整的代码为：

	var tpl = function (scopes) {
		return 'this is ' + scopes[0].title + '!';
	};

	var data = {
		title: 'kissy'
	};

	var render = new XTemplate(tpl).render(data);

	alert(render);// => this is kissy!


