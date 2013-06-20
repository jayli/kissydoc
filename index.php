<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name=viewport content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <title>KISSY: 模块化、接口一致、全终端适配的JS类库</title>
  
  <meta name=description content="The aerogel-weight jQuery-compatible JavaScript library
">
  
  <link rel=stylesheet href=assets/style.css />
  <link rel=stylesheet href=assets/tomorrow-night-bright.css />

  <meta name=apple-mobile-web-app-capable content=yes>
  <meta name=apple-mobile-web-app-status-bar-style content=white>
  <meta name=format-detection content="telephone=no">
	<script src="http://a.tbcdn.cn/s/kissy/1.3.0/seed-min.js"></script>
	<script src="assets/highlight.pack.js"></script>

	<link rel="shortcut icon" href="http://a.tbcdn.cn/s/kissy/favicon.ico" type="image/x-icon" />
</head>
<body>

  <div id="menu_icon">≣</div>

<aside id="sidebar" class="interface">

<h3>Introduction</h3>

  <a class="toc_title" href="#">
    seed.js <span class="version">(1.4.0)</span>
  </a>
  <ul class=toc_section>
    <li class="index"><a href="#download">源代码</a></li>
    <li class="index"><a href="#guide">Hello World</a></li>
    <li class="index"><a href="#blue">模块化机制</a></li>
    <li class="index"><a href="#platforms">平台兼容</a></li>
    <li class="index"><a href="#changelog">历史版本</a></li>
    <li class="index"><a href="#1.4.0">V1.4.0 新特性</a></li>
    <li class="index"><a href="#thanks">致谢</a></li>
  </ul>

  <a class="toc_title" href="#">图例</a>
  <ul class=toc_section>
    <li><a href="#download">静态方法/属性</a></li>
    <li class="blue"><a href="#blue">模块对象</a></li>
    <li class="member"><a href="#guide">实例方法</a></li>
    <li class="gray"><a href="#changelog">继承方法</a></li>
    <li class="event"><a href="#changelog">实例事件</a></li>
  </ul>

  <hr>

<h3>Seed</h3>

  <a class=toc_title href="#loader">loader</a>
  
	<ul class=toc_section>
		<li><a href="#loader_config">config()</a></li>
		<li><a href="#getScript">getScript()</a></li>
		<li><a href="#add">add()</a></li>
		<li><a href="#use">use()</a></li>
	</ul>

  <a class=toc_title href="#core">ua</a>
  
	<ul class=toc_section>
		<li><a href="#">trident</a></li>
		<li><a href="#">webkit</a></li>
		<li><a href="#">gecko</a></li>
		<li><a href="#">presto</a></li>
		<li><a href="#">chrome</a></li>
		<li><a href="#">safari</a></li>
		<li><a href="#">firefox</a></li>
		<li><a href="#">ie</a></li>
		<li><a href="#">opera</a></li>
		<li><a href="#">mobile</a></li>
		<li><a href="#">core</a></li>
		<li><a href="#">shell</a></li>
		<li><a href="#">os</a></li>
		<li><a href="#">ipad</a></li>
		<li><a href="#">iphone</a></li>
		<li><a href="#">ipod</a></li>
		<li><a href="#">ios</a></li>
		<li><a href="#">android</a></li>
	</ul>


  <a class=toc_title href="#core">lang</a>
  
	<ul class=toc_section>
		<li><a href="augment.html">augment()</a></li>
		<li><a href="available.html">available()</a></li>
		<li><a href="bind.html">bind()</a></li>
		<li><a href="buffer.html">buffer()</a></li>
		<li><a href="clone.html">clone()</a></li>
		<li><a href="each.html">each()</a></li>
		<li><a href="endsWith.html">endsWith()</a></li>
		<li><a href="error.html">error()</a></li>
		<li><a href="escapeHTML.html">escapeHTML()</a></li>
		<li><a href="extend.html">extend()</a></li>
		<li><a href="filter.html">filter()</a></li>
		<li><a href="fromUnicode.html">fromUnicode()</a></li>
		<li><a href="globalEval.html">globalEval()</a></li>
		<li><a href="guid.html">guid()</a></li>
		<li><a href="inArray.html">inArray()</a></li>
		<li><a href="indexOf.html">indexOf()</a></li>
		<li><a href="isArray.html">isArray()</a></li>
		<li><a href="isBoolean.html">isBoolean()</a></li>
		<li><a href="isDate.html">isDate()</a></li>
		<li><a href="isEmptyObject.html">isEmptyObject()</a></li>
		<li><a href="isFunction.html">isFunction()</a></li>
		<li><a href="isNull.html">isNull()</a></li>
		<li><a href="isNumber.html">isNumber()</a></li>
		<li><a href="isObject.html">isObject()</a></li>
		<li><a href="isPlainObject.html">isPlainObject()</a></li>
		<li><a href="isRegExp.html">isRegExp()</a></li>
		<li><a href="isString.html">isString()</a></li>
		<li><a href="isUndefined.html">isUndefined()</a></li>
		<li><a href="isWindow.html">isWindow()</a></li>
		<li><a href="keys.html">keys()</a></li>
		<li><a href="lastIndexOf.html">lastIndexOf()</a></li>
		<li><a href="later.html">later()</a></li>
		<li><a href="log.html">log()</a></li>
		<li><a href="makeArray.html">makeArray()</a></li>
		<li><a href="map.html">map()</a></li>
		<li><a href="merge.html">merge()</a></li>
		<li><a href="mix.html">mix()</a></li>
		<li><a href="namespace.html">namespace()</a></li>
		<li><a href="now.html">now()</a></li>
		<li><a href="param.html">param()</a></li>
		<li><a href="parseXML.html">parseXML()</a></li>
		<li><a href="ready.html">ready()</a></li>
		<li><a href="reduce.html">reduce()</a></li>
		<li><a href="startsWith.html">startsWith()</a></li>
		<li><a href="substitute.html">substitute()</a></li>
		<li><a href="throttle.html">throttle()</a></li>
		<li><a href="trim.html">trim()</a></li>
		<li><a href="unEscapeHTML.html">unEscapeHTML()</a></li>
		<li><a href="unique.html">unique()</a></li>
		<li><a href="unparam.html">unparam()</a></li>
		<li><a href="version.html">version()</a></li>
	</ul>

  <a class=toc_title href="#core">features</a>
	<ul class=toc_section>
		<li><a href="#">isDeviceMotionSupported()</a></li>
		<li><a href="#">isHashChangeSupported()</a></li>
		<li><a href="#">isNativeJSONSupported()</a></li>
		<li><a href="#">isTouchSupported()</a></li>
	</ul>


  <hr>

<h3>Core</h3>

  <a class=toc_title href="#core">ajax</a>
  
	<ul class=toc_section>
		<li class="blue"><a href="#">S.Ajax</a></li>
		<li class="blue"><a href="#">S.IO</a></li>
		<li><a href="#">setupConfig()</a></li>
		<li><a href="#">get()</a></li>
		<li><a href="#">post()</a></li>
		<li><a href="#">getJSON()</a></li>
		<li><a href="#">jsonp()</a></li>
		<li><a href="#">upload()</a></li>
		<li><a href="#">serialize()</a></li>
		<li><a href="#">xdrReady()</a></li>
		<li><a href="#">xdrResponse()</a></li>
		<li class="member"><a href="#">abort()</a></li>
		<li class="member"><a href="#">getResponseHeader()</a></li>
		<li class="member"><a href="#">fail()</a></li>
		<li class="member"><a href="#">getNativeXhr()</a></li>
		<li class="member"><a href="#">isRejected()</a></li>
		<li class="member"><a href="#">isResolved()</a></li>
		<li class="member"><a href="#">then()</a></li>
		<li class="event"><a href="#">start</a></li>
		<li class="event"><a href="#">send</a></li>
		<li class="event"><a href="#">progress</a></li>
	</ul>

  <a class=toc_title href="#core">anim</a>
  
	<ul class=toc_section>
		<li class="blue"><a href="#">S.Anim</a></li>
		<li class="member"><a href="#">run()</a></li>
		<li class="member"><a href="#">stop()</a></li>
		<li class="member"><a href="#">pause()</a></li>
		<li class="member"><a href="#">resume()</a></li>
		<li class="member"><a href="#">isRunning()</a></li>
		<li class="member"><a href="#">isPaused()</a></li>
		<li class="event"><a href="#">beforeStart</a></li>
		<li class="event"><a href="#">complete</a></li>
		<li class="event"><a href="#">step</a></li>
	</ul>

  <a class=toc_title href="#core">base</a>
  
	<ul class=toc_section>
		<li class="blue"><a href="#">S.Base</a><font color="blue">(Base参元类)</font></li>
	</ul>

  <a class=toc_title href="#core">cookie</a>
  
	<ul class=toc_section>
		<li><a href="#">get()</a></li>
		<li><a href="#">set()</a></li>
		<li><a href="#">remove()</a></li>
	</ul>

  <a class=toc_title href="#core">dom</a>
  
	<ul class=toc_section>
		<li><a href="selector.html">selector()</a></li>
		<li><a href="query.html">query()</a></li>
		<li><a href="get.html">get()</a></li>
		<li><a href="filter.html">filter()</a></li>
		<li><a href="test.html">test()</a></li>
		<li><a href="clone.html">clone()</a></li>
		<li><a href="hasClass.html">hasClass()</a></li>
		<li><a href="addClass.html">addClass()</a></li>
		<li><a href="removeClass.html">removeClass()</a></li>
		<li><a href="replaceClass.html">replaceClass()</a></li>
		<li><a href="toggleClass.html">toggleClass()</a></li>
		<li><a href="removeAttr.html">removeAttr()</a></li>
		<li><a href="attr.html">attr()</a></li>
		<li><a href="hasAttr.html">hasAttr()</a></li>
		<li><a href="prop.html">prop()</a></li>
		<li><a href="hasProp.html">hasProp()</a></li>
		<li><a href="val.html">val()</a></li>
		<li><a href="text.html">text()</a></li>
		<li><a href="css.html">css()</a></li>
		<li><a href="style.html">style()</a></li>
		<li><a href="width.html">width()</a></li>
		<li><a href="height.html">height()</a></li>
		<li><a href="innerWidth.html">innerWidth()</a></li>
		<li><a href="innerHeight.html">innerHeight()</a></li>
		<li><a href="outerWidth.html">outerWidth()</a></li>
		<li><a href="outerHeight.html">outerHeight()</a></li>
		<li><a href="addStyleSheet.html">addStyleSheet()</a></li>
		<li><a href="show.html">show()</a></li>
		<li><a href="hide.html">hide()</a></li>
		<li><a href="toggle.html">toggle()</a></li>
		<li><a href="offset.html">offset()</a></li>
		<li><a href="scrollTop.html">scrollTop()</a></li>
		<li><a href="scrollLeft.html">scrollLeft()</a></li>
		<li><a href="docHeight.html">docHeight()</a></li>
		<li><a href="docWidth.html">docWidth()</a></li>
		<li><a href="viewportHeight.html">viewportHeight()</a></li>
		<li><a href="viewportWidth.html">viewportWidth()</a></li>
		<li><a href="scrollIntoView.html">scrollIntoView()</a></li>
		<li><a href="dom-index.html">index()</a></li>
		<li><a href="parent.html">parent()</a></li>
		<li><a href="next.html">next()</a></li>
		<li><a href="prev.html">prev()</a></li>
		<li><a href="first.html">first()</a></li>
		<li><a href="last.html">last()</a></li>
		<li><a href="siblings.html">siblings()</a></li>
		<li><a href="children.html">children()</a></li>
		<li><a href="contains.html">contains()</a></li>
		<li><a href="create.html">create()</a></li>
		<li><a href="html.html">html()</a></li>
		<li><a href="remove.html">remove()</a></li>
		<li><a href="empty.html">empty()</a></li>
		<li><a href="insertBefore.html">insertBefore()</a></li>
		<li><a href="insertAfter.html">insertAfter()</a></li>
		<li><a href="append.html">append()</a></li>
		<li><a href="prepend.html">prepend()</a></li>
		<li><a href="replaceWith.html">replaceWith()</a></li>
		<li><a href="data.html">data()</a></li>
		<li><a href="removeData.html">removeData()</a></li>
		<li><a href="hasData.html">hasData()</a></li>
		<li><a href="unselectable.html">unselectable()</a></li>
		<li><a href="contents.html">contents()</a></li>
		<li><a href="wrap.html">wrap()</a></li>
		<li><a href="wrapAll.html">wrapAll()</a></li>
		<li><a href="unwrap.html">unwrap()</a></li>
		<li><a href="wrapInner.html">wrapInner()</a></li>
		<li><a href="nodeName.html">nodeName()</a></li>
		<li><a href="outerHTML.html">outerHTML()</a></li>

	</ul>


  <a class=toc_title href="#core">event</a>
  
	<ul class=toc_section>
		<li class="blue"><a href="#"><b>EventTarget</b></a><font color="blue">(事件参元类)</font></li>
		<li class="blue"><a href="#"><b>EventObject</b></a><font color="blue">(事件门面对象)</font></li>
		<li><a href="#">on()</a></li>
		<li><a href="#">delegate()</a></li>
		<li><a href="#">detach()</a></li>
		<li><a href="#">undelegate()</a></li>
		<li><a href="#">fire()</a></li>
		<li><a href="#">fireHandler()</a></li>
	</ul>


  <a class=toc_title href="#core">json</a>
  
	<ul class=toc_section>
		<li><a href="#">parse()</a></li>
		<li><a href="#">stringify()</a></li>
	</ul>

  <a class=toc_title href="#core">node</a>
  
	<ul class=toc_section>
		<li class="member"><a href="instance_all.html">all()</a></li>
		<li class="member"><a href="instance_one.html">one()</a></li>
		<li class="member"><a href="getDOMNodes.html">getDOMNodes()</a></li>
		<li class="member"><a href="getDOMNode.html">getDOMNode()</a></li>
		<li class="member"><a href="end.html">end()</a></li>
		<li class="member"><a href="equals.html">equals()</a></li>
		<li class="member"><a href="add.html">add()</a></li>
		<li class="member"><a href="item.html">item()</a></li>
		<li class="member"><a href="slice.html">slice()</a></li>
		<li class="member"><a href="scrollTop.html">scrollTop()</a></li>
		<li class="member"><a href="scrollLeft.html">scrollLeft()</a></li>
		<li class="member"><a href="height.html">height()</a></li>
		<li class="member"><a href="width.html">width()</a></li>
		<li class="member"><a href="addStyleSheet.html">addStyleSheet()</a></li>
		<li class="member"><a href="append.html">append()</a></li>
		<li class="member"><a href="appendTo.html">appendTo()</a></li>
		<li class="member"><a href="prepend.html">prepend()</a></li>
		<li class="member"><a href="prependTo.html">prependTo()</a></li>
		<li class="member"><a href="insertBefore.html">insertBefore()</a></li>
		<li class="member"><a href="before.html">before()</a></li>
		<li class="member"><a href="after.html">after()</a></li>
		<li class="member"><a href="insertAfter.html">insertAfter()</a></li>
		<li class="member"><a href="animate.html">animate()</a></li>
		<li class="member"><a href="stop.html">stop()</a></li>
		<li class="member"><a href="pause.html">pause()</a></li>
		<li class="member"><a href="resume.html">resume()</a></li>
		<li class="member"><a href="isRunning.html">isRunning()</a></li>
		<li class="member"><a href="isPaused.html">isPaused()</a></li>
		<li class="member"><a href="show.html">show()</a></li>
		<li class="member"><a href="hide.html">hide()</a></li>
		<li class="member"><a href="toggle.html">toggle()</a></li>
		<li class="member"><a href="fadeIn.html">fadeIn()</a></li>
		<li class="member"><a href="fadeOut.html">fadeOut()</a></li>
		<li class="member"><a href="fadeToggle.html">fadeToggle()</a></li>
		<li class="member"><a href="slideDown.html">slideDown()</a></li>
		<li class="member"><a href="slideUp.html">slideUp()</a></li>
		<li class="member"><a href="slideToggle.html">slideToggle()</a></li>
		<li class="gray"><a href="">继承自dom/event的方法</a></li>
	</ul>

  <a class=toc_title href="#core">uri</a>

	<ul class=toc_section>
		<li class="blue"><a href="#">S.Uri</a></li>
		<li class="member"><a href="#">every()</a></li>
		<li class="member"><a href="#">some()</a></li>
		<li class="member"><a href="#">stamp()</a></li>
		<li class="member"><a href="#">clone()</a></li>
		<li class="member"><a href="#">resolve()</a></li>
		<li class="member"><a href="#">getScheme()</a></li>
		<li class="member"><a href="#">setScheme()</a></li>
		<li class="member"><a href="#">getHostname()</a></li>
		<li class="member"><a href="#">setHostname()</a></li>
		<li class="member"><a href="#">getUserInfo()</a></li>
		<li class="member"><a href="#">setUserInfo()</a></li>
		<li class="member"><a href="#">setPort()</a></li>
		<li class="member"><a href="#">getPort()</a></li>
		<li class="member"><a href="#">setPath()</a></li>
		<li class="member"><a href="#">getPath()</a></li>
		<li class="member"><a href="#">setQuery()</a></li>
		<li class="member"><a href="#">getQuery()</a></li>
		<li class="member"><a href="#">getFragment()</a></li>
		<li class="member"><a href="#">setFragment()</a></li>
		<li class="member"><a href="#">isSameOriginAs()</a></li>
		<li class="member"><a href="#">toString()</a></li>
	</ul>

  <a class=toc_title href="#core">promise</a>
	<ul class=toc_section>
		<li class="blue"><a href="#">S.Promise</a><font color=blue>(内部调用)</font></li>
		<li class="blue"><a href="#">S.Defer</a><font color=blue>(内部调用)</font></li>
	</ul>

  <a class=toc_title href="#core">path</a> 
	<ul class=toc_section>
		<li><a href="">basename()</a></li>
		<li><a href="">dirname()</a></li>
		<li><a href="">extname()</a></li>
		<li><a href="">join()</a></li>
		<li><a href="">normalize()</a></li>
		<li><a href="">relative()</a></li>
		<li><a href="">resolve()</a></li>
	</ul>

<hr />

<h3>Mobile 支持</h3>

  <a class=toc_title href="#core">Mobile Events</a>
	<ul class=toc_section>
		<li class="index"><a href="#">Touch Events</a></li>
	</ul>

  <a class=toc_title href="#core">UA 探测</a>
	<ul class=toc_section>
		<li class="index"><a href="#">Mobile UA</a></li>
	</ul>

</aside>

<div class="container">
	<?php
		include('doc.html');
	?>
</div>

<script>

</script>

  <script>
	var S = KISSY;
	(function(){
		S.use('node',function(S){
			S.all('code').each(function(node){
				var className = node.attr('class');
				if(/^lang-/.test(className)){
					var tc = className.replace(/^lang-/,'');
					node.replaceClass(className,tc);
				}
			});
			hljs.tabReplace = '    ';
			hljs.initHighlighting();
		});
		S.use('node',function(S){
			if(S.UA.os === "windows"){
				S.all('.toc_section').css({
					'font-size':'12px'
				});
			}
		});
	})();
  </script>

</body>
</html>
