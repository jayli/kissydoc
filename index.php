<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name=viewport content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <title>Zepto.js: the aerogel-weight jQuery-compatible JavaScript library</title>
  
  <meta name=description content="The aerogel-weight jQuery-compatible JavaScript library
">
  
  <link rel=stylesheet href=style.css>

  <meta name=apple-mobile-web-app-capable content=yes>
  <meta name=apple-mobile-web-app-status-bar-style content=white>
  <meta name=format-detection content="telephone=no">

  <link rel=apple-touch-icon-precomposed href=icon.png>
  <link rel=icon type=image/png href=favicon.png>
</head>
<body>

  <div id="menu_icon">≣</div>

<aside id="sidebar" class="interface">

  <a class="toc_title" href="#">
    Zepto.js <span class="version">(1.0)</span>
  </a>

  <ul class=toc_section>
    <li><a href="#download">Download</a></li>
    <li><a href="#platforms">Target Platforms</a></li>
    <li><a href="#changelog">Change Log</a></li>
    <li><a href="#thanks">Acknowledgements</a></li>
  </ul>

  <hr>

  <a class=toc_title href="#core">Core</a>
  
  <ul class=toc_section>
  
  <li><a href="#$()">$()</a></li>
  
  <li><a href="#$.camelCase">$.camelCase</a></li>
  
  <li><a href="#$.contains">$.contains</a></li>
  
  <li><a href="#$.each">$.each</a></li>
  
  <li><a href="#$.extend">$.extend</a></li>
  
  <li><a href="#$.fn">$.fn</a></li>
  
  <li><a href="#$.grep">$.grep</a></li>
  
  <li><a href="#$.inArray">$.inArray</a></li>
  
  <li><a href="#$.isArray">$.isArray</a></li>
  
  <li><a href="#$.isFunction">$.isFunction</a></li>
  
  <li><a href="#$.isPlainObject">$.isPlainObject</a></li>
  
  <li><a href="#$.isWindow">$.isWindow</a></li>
  
  <li><a href="#$.map">$.map</a></li>
  
  <li><a href="#$.parseJSON">$.parseJSON</a></li>
  
  <li><a href="#$.trim">$.trim</a></li>
  
  <li><a href="#$.type">$.type</a></li>
  
  <li><a href="#add">add</a></li>
  
  <li><a href="#addClass">addClass</a></li>
  
  <li><a href="#after">after</a></li>
  
  <li><a href="#append">append</a></li>
  
  <li><a href="#appendTo">appendTo</a></li>
  
  <li><a href="#attr">attr</a></li>
  
  <li><a href="#before">before</a></li>
  
  <li><a href="#children">children</a></li>
  
  <li><a href="#clone">clone</a></li>
  
  <li><a href="#closest">closest</a></li>
  
  <li><a href="#concat">concat</a></li>
  
  <li><a href="#contents">contents</a></li>
  
  <li><a href="#css">css</a></li>
  
  <li><a href="#data">data</a></li>
  
  <li><a href="#each">each</a></li>
  
  <li><a href="#empty">empty</a></li>
  
  <li><a href="#eq">eq</a></li>
  
  <li><a href="#filter">filter</a></li>
  
  <li><a href="#find">find</a></li>
  
  <li><a href="#first">first</a></li>
  
  <li><a href="#forEach">forEach</a></li>
  
  <li><a href="#get">get</a></li>
  
  <li><a href="#has">has</a></li>
  
  <li><a href="#hasClass">hasClass</a></li>
  
  <li><a href="#height">height</a></li>
  
  <li><a href="#hide">hide</a></li>
  
  <li><a href="#html">html</a></li>
  
  <li><a href="#index">index</a></li>
  
  <li><a href="#indexOf">indexOf</a></li>
  
  <li><a href="#insertAfter">insertAfter</a></li>
  
  <li><a href="#insertBefore">insertBefore</a></li>
  
  <li><a href="#is">is</a></li>
  
  <li><a href="#last">last</a></li>
  
  <li><a href="#map">map</a></li>
  
  <li><a href="#next">next</a></li>
  
  <li><a href="#not">not</a></li>
  
  <li><a href="#offset">offset</a></li>
  
  <li><a href="#offsetParent">offsetParent</a></li>
  
  <li><a href="#parent">parent</a></li>
  
  <li><a href="#parents">parents</a></li>
  
  <li><a href="#pluck">pluck</a></li>
  
  <li><a href="#position">position</a></li>
  
  <li><a href="#prepend">prepend</a></li>
  
  <li><a href="#prependTo">prependTo</a></li>
  
  <li><a href="#prev">prev</a></li>
  
  <li><a href="#prop">prop</a></li>
  
  <li><a href="#push">push</a></li>
  
  <li><a href="#ready">ready</a></li>
  
  <li><a href="#reduce">reduce</a></li>
  
  <li><a href="#remove">remove</a></li>
  
  <li><a href="#removeAttr">removeAttr</a></li>
  
  <li><a href="#removeClass">removeClass</a></li>
  
  <li><a href="#replaceWith">replaceWith</a></li>
  
  <li><a href="#scrollTop">scrollTop</a></li>
  
  <li><a href="#show">show</a></li>
  
  <li><a href="#siblings">siblings</a></li>
  
  <li><a href="#size">size</a></li>
  
  <li><a href="#slice">slice</a></li>
  
  <li><a href="#text">text</a></li>
  
  <li><a href="#toggle">toggle</a></li>
  
  <li><a href="#toggleClass">toggleClass</a></li>
  
  <li><a href="#unwrap">unwrap</a></li>
  
  <li><a href="#val">val</a></li>
  
  <li><a href="#width">width</a></li>
  
  <li><a href="#wrap">wrap</a></li>
  
  <li><a href="#wrapAll">wrapAll</a></li>
  
  <li><a href="#wrapInner">wrapInner</a></li>
  
</ul>

  
  <a class=toc_title href="#detect">Detect</a>
  
  <ul class=toc_section>
  
  <li><a href="#Detect module">Detect module</a></li>
  
</ul>


  <a class=toc_title href="#event">Event</a>
  
  <ul class=toc_section>
  
  <li><a href="#$.Event">$.Event</a></li>
  
  <li><a href="#$.proxy">$.proxy</a></li>
  
  <li><a href="#bind">bind</a></li>
  
  <li><a href="#delegate">delegate</a></li>
  
  <li><a href="#die">die</a></li>
  
  <li><a href="#live">live</a></li>
  
  <li><a href="#off">off</a></li>
  
  <li><a href="#on">on</a></li>
  
  <li><a href="#one">one</a></li>
  
  <li><a href="#trigger">trigger</a></li>
  
  <li><a href="#triggerHandler">triggerHandler</a></li>
  
  <li><a href="#unbind">unbind</a></li>
  
  <li><a href="#undelegate">undelegate</a></li>
  
</ul>


  <a class=toc_title href="#ajax">Ajax</a>
  
  <ul class=toc_section>
  
  <li><a href="#$.ajax">$.ajax</a></li>
  
  <li><a href="#$.ajaxJSONP">$.ajaxJSONP</a></li>
  
  <li><a href="#$.ajaxSettings">$.ajaxSettings</a></li>
  
  <li><a href="#$.get">$.get</a></li>
  
  <li><a href="#$.getJSON">$.getJSON</a></li>
  
  <li><a href="#$.param">$.param</a></li>
  
  <li><a href="#$.post">$.post</a></li>
  
  <li><a href="#load">load</a></li>
  
</ul>


  <a class=toc_title href="#form">Form</a>
  
  <ul class=toc_section>
  
  <li><a href="#serialize">serialize</a></li>
  
  <li><a href="#serializeArray">serializeArray</a></li>
  
  <li><a href="#submit">submit</a></li>
  
</ul>


  <a class=toc_title href="#fx">Effects</a>
  
  <ul class=toc_section>
  
  <li><a href="#$.fx">$.fx</a></li>
  
  <li><a href="#animate">animate</a></li>
  
</ul>


  <a class=toc_title href="#touch">Touch</a>
  
  <ul class=toc_section>
  
  <li><a href="#Touch events">Touch events</a></li>
  
</ul>

</aside>

<div class="container">
	<?php
		include('doc.html');
	?>
</div>

<script src="zepto.min.js"></script>
<script src="touch.js"></script>

<script>
  var reflowTimeout;
  
  function injectScript(src) {
    var s = document.createElement('script')
    s.src = src; s.async = true
    $('script').first().before(s)
  }

  // Reflow all elements on the page. <david@14islands.com>
  function reflowFixedPositions() {
    var docStyle = document.documentElement.style
    docStyle.paddingRight = '1px'
    setTimeout(function(){ docStyle.paddingRight = '' }, 0)
  }

  $('.signature code').html(function(i, html){
    return html
      .replace(/\[([^\[]+)\]$/mg, '<span class=version>$1+</span>')
      .replace(/\)([^()]+)$/mg, ') <span class=return>$1</span>')
  })

  $(document).on('mouseover', 'span.version', function(){
    var el = $(this)
    if (!el.attr('title'))
      el.attr('title', "This feature is only available in Zepto " + el.text())
  })

  if ($.os.ios || /\bMac.+\bSafari\b/.test(navigator.userAgent))
    $(document.body).addClass('emoji-enabled')
    
  // don't follow links when the sidebar is tap-enabled
  $('#sidebar').on('click', 'a', function(e){
    return !$('body').hasClass('navigating')
  })

  $('#sidebar').on('tap', 'a', function(e){
    location.href = this.href;

    closeMenu()
    setTimeout(function(){
      // fixes sidebar becoming unscrollable in Safari 6
      reflowFixedPositions()
    }, 10)    
    return false
  })
  
  $(window).on('scroll', function(){
    if(reflowTimeout) clearTimeout(reflowTimeout)
    reflowTimeout = setTimeout(reflowFixedPositions, 200)
  })
  
  function closeMenu(){
    if ($('body').hasClass('navigating')) {
      $('body').removeClass('navigating')
      setTimeout(function(){
        $('#sidebar').css('display','none')
      }, 350)
    }
  }
  
  // show/hide menu on mobile
  $('#menu_icon').on('tap', function(){
    if ($('body').hasClass('navigating')) {
      closeMenu()
    } else {
      $('#sidebar').css('display','block')
      $('#sidebar')[0].offsetLeft // force render
      $('body').addClass('navigating')
    }
    return false
  })

  // change the title of the page so bookmarks have a better default
  if ($.os.ios || $.os.android)
    document.title = 'Zepto Docs'

  // For retina screens, use a hi-res version of the tour image.
  // We're swapping this out on-demand (not an ideal solution)
  // to avoid rendering bugs on iOS.
  $('#tour > img')[0].src =
    ('devicePixelRatio' in window && devicePixelRatio > 1) ?
    'intro2x.jpg' : 'intro.jpg'

  var tour = $('#tour'), tourSlides = tour.children(),
      tourSlide = 0, tourSlidesTotal = 5

  function advanceTourSlide(delta){
    tourSlide = (tourSlide + delta + tourSlidesTotal) % tourSlidesTotal
    var offset = tourSlide * tour.width()
    tourSlides.animate({ translateX: -offset + 'px' })
  }

  tour.on('click swipeLeft', function(){ advanceTourSlide(+1) })
      .on('swipeRight', function(){ advanceTourSlide(-1) })

  if (/^localhost|\.(dev|local)$/.test(location.hostname) && $.os.iphone && !/Simulator/.test(navigator.userAgent))
    injectScript('livereload.js')

  if (/\.com$/.test(location.hostname))
    injectScript('http://platform.twitter.com/widgets.js')
</script>

<script>
  var _gauges = _gauges || [];
  if (/\.com$/.test(location.hostname)) (function() {
    var t   = document.createElement('script');
    t.type  = 'text/javascript';
    t.async = true;
    t.id    = 'gauges-tracker';
    t.setAttribute('data-site-id', '4f46b5c5f5a1f573c300004c');
    t.src = '//secure.gaug.es/track.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(t, s);
  })();
</script>


</body>
</html>
