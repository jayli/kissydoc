

## KISSY Slide 组件

组件首页：[http://gallery.kissyui.com/slide/1.1/guide/index.html](http://gallery.kissyui.com/slide/1.1/guide/index.html)

### New Featurs

![](http://img01.taobaocdn.com/tps/i1/T1TVJnFkRaXXaNgj.x-431-203.jpg)

Slide是一个幻灯切换组件，和KISSY Core中的[switchable组件](http://docs.kissyui.com/docs/html/api/component/switchable/switchable.html)不同，它更注重功能和对外暴露的Api以及事件的设计，帮你完成对它的二次封装。相比于switchable，Slide组件增加这些功能

1，暴露最常用的事件
	
- switch：发生切换
- beforeSwitch：切换发生前
- afterSwitch：切换发生后
- beforeTailSwitch：切换出去之前

2，增加控件尺寸的自适应，特别是在窗口可变的场景中的适配
3，分层动画
4，Mobile中的触屏支持

### 示例代码

Slide内嵌在Gallery中，当前版本为1.1，初始化方法：

	<script>
		KISSY.use('gallery/slide/1.1/',function(S,Slide){
			new Slide('id');// 同时支持选择器"#id",HTMLElement 和 nodeElement
		});
	</script>

Slide依赖典型的HTML结构

![](http://img04.taobaocdn.com/tps/i4/T16ZuQXpRhXXcw.ZY_-414-191.png)

其中：

- ul.tab-nav,导航，可以留空
- ul.tab-nav li.selected,选中的tab页签
- div.tab-content，内容容器
- div.tab-content div.tab-pannel，内容面板

更多配置项示例：

	new Slide('J_tab',{
		eventype:'click',//tab上的触发事件
		effect:'vSlide',//切换效果为纵向滚动
		autoSlide:true,//自动播放
		timeout:2000,//切换时间间隔
		speed:500,//切换速度，越小越快，单位为毫秒
		hoverStop:true//鼠标经过内容是否停止播放
	});

### 跑马灯原理

跑马灯是可以连续相同方向滚动的幻灯，帧首尾相连接。有两种实现方式，一种是滚动时将首（尾）的节点拷贝至尾（首），另一种是初始化时处理首尾的节点，滚动时只改变位置，出于性能的考虑，Slide采用第二种方式。

即同时复制多个帧至首位，数量根据Slide组件的colspan参数指定，比如colspan为2，则滑块的跨度为2，复制两分，如图：

![](http://img02.taobaocdn.com/tps/i2/T1xl62Xb0fXXXcUVob-597-199.png)

切换幻灯的动作实际上是滑块移动的操作，滑块定位在初始位置由参数defaultTab指定，默认为0，如果colspan指定了跨度为2，则滑块初始位置为：

![](http://img01.taobaocdn.com/tps/i1/T1Cj61XcJkXXXuXRQf-599-148.png)

因为节点被复制，而在IE和W3C中复制节点有差异，IE会复制事件，W3C默认不会复制节点事件，因此，帧里的元素如果绑定了事件，可能在赋值过程中被丢掉。

### 长宽自适应的Slide

页面运行时的尺寸可能会有变化，当宽屏变窄屏时，Slide组件也需要自适应，尤其是在Mobile中横评竖屏切换时，需要设置适应宽度的属性，比如假设Slide的宽度始终跟随浏览器的宽度走，这样传参：

	var slide = new Slide('J_tab',{
		adaptive_width:function(){
			return document.body.offsetWidth;
		}
	});

### 跨帧动画

![](http://img01.taobaocdn.com/tps/i1/T1xRXkFghdXXX1y07T-443-136.gif)

跨帧动画是Slide全副动画的变种，支持切换其中一部分。只需传入colspan参数即可

	new Slide('JSlide',{
		effect:'hSlide', //水平切换
		carousel:true, //可以配置为跑马灯,也可以为false
		colspan:3 // 定义跨度为3
	});


### 多帧动画 LayerSlide

分层动画是最近很火的设计小彩蛋，简单的分层动画可以营造Flash一般的效果，比如[LayerSlide](http://kreaturamedia.com/layerslider-responsive-jquery-slider-plugin/)。只是这种基于Jquery的代码体积既笨重（Kissy Slide体积比LayerSlide小一半）又场景单一。KISSY Slide支持分层动画，[Demo](http://mobile.kissyui.com/mobile/slide/1.1/demo/d4.html?ks-debug)。

![](http://img03.taobaocdn.com/tps/i3/T10MpmFdJaXXaarIcl-530-276.gif)

分层动画只需在初始化时打开开关：

- layerSlide:true

在HTML中，需要指定每一帧的 `alt="sublayer"`，并给出每个sublayer的动画模式：

	<span alt="sublayer" 
		rel="alpha: true,slideindirection: left, durationin: 1000"
		class="自定义">SubLayer</span>

其中rel为当前层动画的配置参数，采用key:value的形式定义，多属性之间用逗号分隔，注意结束位置不要写逗号。sublayer的配置参数请参照[这里](http://gallery.kissyui.com/slide/1.1/guide/index.html?spm=0.0.0.0.GgiuTk#LayerSlide_%E5%8A%A8%E7%94%BB)。

ps:目前Gallery中已有了更强大的专门作分层动画的组件[Layer-anim](http://gallery.kissyui.com/layer-anim/1.0/guide/index.html)，支持动画反向播放。

### 触屏支持

组件会检测硬件设备，在移动设备中自动件支持触屏事件，用手指左后滑动切换幻灯。[Demo](gallery.kissyui.com/slide/1.1/demo/touch.html?ks-debug)。

![](http://img01.taobaocdn.com/tps/i1/T14bJeFf8hXXbsjuY7-490-320.png)

同时，Slide组件还提供touchmove参数，在帧元素很多的时候，帧跟随手指滑动会很耗内存，这时需要配置`touchmove:true`，来启动手指滑动结束后执行帧的左右滑动。

KISSY Slide 实现了[FlipSnap](http://pxgrid.github.io/js-flipsnap/doc.html)的几乎所有功能。

### Slide的二次封装

Slide 提供丰富的参数适合被二次封装，这里有两个例子：

第一个：[Mobile 相册控件](http://mobile.kissyui.com/markdown.php?mobile/photoswipe/1.0/guide/index.md)

![](http://img02.taobaocdn.com/tps/i2/T1QJxlFdpdXXcpQiLo-570-430.png)

第二个：[Mobile App Toolkit](http://mobile.kissyui.com/markdown.php?mobile/app/1.2/index.md)

因为 Slide 提供足够的 API，比如几个常见的方法

- previous() 上一帧
- next() 下一帧
- add() 添加一帧
- remove() 删除一帧
- removeLast() 删除最后一帧
- play() 开始自动播放
- stop() 停止自动播放
- `is_first()` 是否是第一帧
- `is_last()` 是否是最后一帧

常用的属性

- currentTab，当前帧的索引
- length，帧的个数
- pannels，当前面板的数组

### Slide V 1.2 版本计划

目前Slide为1.1版本，V1.2版本将增加这些特性支持

- 切换特效的性能优化，特别是针对Android的动画优化
- 垂直切换的触屏支持
- Slide体积瘦身
- 切换过程的Hisory管理
- 插件机制

文档和Demo

- 1.1版的完整文档：[http://gallery.kissyui.com/slide/1.1/guide/index.html](http://gallery.kissyui.com/slide/1.1/guide/index.html)
- 1.1版完整demo：[http://gallery.kissyui.com/slide/1.1/demo/index.html](http://gallery.kissyui.com/slide/1.1/demo/index.html)

鸣谢：承玉、明正、阿古、栋寒、虎牙

