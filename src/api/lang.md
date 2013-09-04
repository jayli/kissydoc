# lang 

> lang 是一套`underscore`风格的工具集，提供一些常用的工具函数，`lang` 模块内嵌在 `seed.js` 内，无需额外引入，这些函数直接挂载在 KISSY 全局对象上。

### augment()

`augment(r, s1 [, s2 , ...], ov = true, wl) => Function`

将 s1,s2.... 的 `prototype` 属性的成员复制到 `r.prototype` 上。这时被复制的成员来自于一个Fucntion对象，这个对象一般被称为掺元类（mixin class）。比如 KISSY 里的 CustemEvent 就是一个掺元类。掺元类只是被扩充用的。参数说明：

#### parameters

- r (function) – 将要扩充的函数
- `...s1` (function|object) – 扩充来源函数或对象. 非函数对象时复制的就是 s 的成员.
- ov (boolean) – 是否覆盖 r.prototype 同名属性.
- whitelist (Array<string>) – 属性来源对象的属性白名单, 仅在名单中的属性进行复制.

#### return

- `r`（function），即将要扩充的函数

#### Example


	var S = KISSY,
	Shoutable = {
		shout: function() { alert('I am ' + this.name + '.'); }
	};

	function Dog(name) { this.name = 'Dog ' + name; }
	function Pig(name) { this.name = 'Pig ' + name; }

	S.augment(Dog, Shoutable);
	S.augment(Pig, Shoutable);

	new Dog('Jack').shout(); // => I am Dog Jack.
	new Pig('Mary').shout(); // => I am Pig Mary.

augment 方法在 KISSY 里非常基础非常重要. 传统 OO 语言里, 可以通过继承或接口来实现共性方法. 在 JavaScript 里, 通过 mixin 特性, 一切变得更简单. augment 是动态语言 mixin 特性的体现, 灵活运用, 能让代码非常优雅简洁.

### available()

`available (id,fn) => void`

监听某个节点是否处于可用状态，如果可用，执行回调，此函数一般在要监听的DOM节点执行之前绑定到节点。

#### parameters

- id (string) – 页面元素 id
- fn (function) – 回调函数, 在 id 元素可用时立刻执行.

### bind()

`bind (fn , context[, arg1[, arg2[, ...]]]) => Function`

创建一个新函数，该函数可以在固定的上下文以及传递部分固定参数放在用户参数前面给原函数并执行

#### parameters

- fn (function) – 需要固定上下文以及固定部分参数的函数
- context (object) – 执行 fn 时的 this 值. 如果新函数用于构造器则该参数无用.

#### return

- Function，符合需求的新函数

#### Example 1，改变运行上下文

bind 最简单的用法是生成一个新的函数，无论它如何调用，都运行在一个固定的 this 值中，入门者常犯的错误时从一个对象获得一个方法引用， 然后在后面的调用中期望这个方法的this就是原来的对象(eg.g 把这个方法用在某个回调中). 如果没有特例，那么这个原始对象就丢失了. 但是如果从原方法中得到一个绑定原始对象的函数，这个问题就解决了！

	var x = 9;
	var module = {
		x: 81,
		getX: function() { return this.x; }
	};

	module.getX(); // 81

	var getX = module.getX;
	getX(); // 9, 这里，this 指向全局Global对象

	// 创建一个新函数，函数的上下文this绑定至module
	var boundGetX = KISSY.bind(getX,module);
	boundGetX(); // 81

#### Example 2，Currying

bind 的下一个简单用法是产生一个具备默认参数的函数. 这些参数跟在 context 后面，无论何时调用绑定函数， 当绑定函数调用目标函数时会把它们放在参数列表开头，然后才是传递给绑定函数的用户参数.

	function list() {
		return Array.prototype.slice.call(arguments);
	}

	var list1 = list(1, 2, 3); // [1, 2, 3]

	// 使用当前参数创建一个新函数
	var leadingZeroList = KISSY.bind(list,undefined, 37);

	var list2 = leadingZeroList(); // [37]
	var list3 = leadingZeroList(1, 2, 3); // [37, 1, 2, 3]

### buffer()

`buffer (fn, ms, context)`

将 fn 缓存一段时间后, 再被调用执行

#### parameters

- fn (Function) – 要缓存的函数;
- ms (Number) – 要缓存多长时间后执行, 默认是 150 ms;
- context (Object) – 函数 fn 要执行时的上下文环境, 默认是 this;

#### return

- Function，返回缓存后的函数对象

> 此方法为了避免在 ms 段时间内, 执行 fn 多次. 常用于 resize , scroll , mousemove 等连续性事件中；当 ms 设置为 -1, 表示立即执行 fn, 即和直接调用 fn 一样;

#### Example

	self.__onResize = S.buffer(doResize, 100, this);
	$(window).on("resize", self.__onResize);

### clone()

`clone (o[,filter]) => Object`

创建一个 普通对象 或数组的深拷贝, 并且返回.

#### parameters

- o (object|Array) – 待深拷贝的对象或数组.
- filter – 过滤函数, 返回 false 不拷贝该元素. 传入参数为:
	- 待克隆值为数组, 参数同 KISSY.filter() , 上下文对象为全局 window
	- 待克隆值为普通对象, 参数为对象的每个键, 每个键对应的值, 当前对象, 上下文对象为当前对象.

#### return

- Object，拷贝后的新对象

> DOM 节点的克隆请用 dom.clone()

#### example

	var S = KISSY;
	var a={x:{y:{z:1}}}
	var b=S.clone(a); // => b={x:y:{z:1}} , b!==a
	var c=S.clone(a,function(v,k){if(k=="z") return false;}) // => c={x:{y:{}}}

### each()

`each ( o, fn[, context] )`

遍历数组中的每一项, 执行指定方法.

### parameters

- o (Array|object) – 需要遍历的数组或对象
- fn (function) – 执行时, 接收 3 个参数：
	- 当 o 为数组时, 参数为当前数组单项值, 当前 index, 数组 o
	- 当 o 为对象时, 参数为当前值 (value), 当前键 (key), 对象 o
- context (object) – fn 的上下文对象, 不指定为全局 window


	var S = KISSY,
	arr = [1, 2, 3, 4, 5],
	obj = {
		'hi': 'kissy',
		'bye': 'world'
	},
	sum = 0;

	S.each(arr, function(item) {
		sum += item;
	});
	S.log(sum); // => 15


	S.each(obj, function(v,k) {
		S.log([v,k]);
	});

### endsWith()

`endsWith (str,suffix) => Boolean`

判断 str 是否以 suffix 结尾

#### parameters

- str (string) – 查找字符串
- suffix (string) – 后缀字符串

#### return

- Boolean，str 是否以 suffix 结尾

### error()

`error (msg) => void`

#### parameters

- msg(string) - 一场信息

> 只有在 debug 模式下, 才会抛出异常. debug 模式的说明请参考 Config

### escapeHTML()

`escapeHTML (str) => String`

将字符串经过 html 转义得到适合在页面中显示的内容, 例如替换 `<` 为 `&lt;`

#### parameters

- str (string) – 要显示在页面中的真实内容

#### return

- string，经过 html 转义后的字符串

#### example

	KISSY.escapeHTML("<a>x</a>"); // =>  "&lt;a&gt;x&lt;/a&gt;"

> 此函数只会对以下符号进行 escape：`& > < / " '`&prime; 等

