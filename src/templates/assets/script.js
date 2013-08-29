// Agency code.

(function() {
$( document ).ready( function() {

  //
  $( window ).bind( 'load resize', setMenuBackgroundHeight );

  setMenuBackgroundHeight();

});


var setMenuBackgroundHeight = function() {

  var d = $( '#content').height();
  var w = $( window ).width();

  if( w > 760 ) {
	  console.log(d);
    $( '#sidebar' ).css( { "min-height": (d) } );
  } else {
    $( '#sidebar' ).css( { "min-height": (100) } );
  }

};

})();

