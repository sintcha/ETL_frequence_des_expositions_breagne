( function( $ ) {
	// Drastically modified from the function in the WordPress Twenty Fifteen theme
	// Original source: https://github.com/WordPress/WordPress/blob/master/wp-content/themes/twentyfifteen/js/functions.js

	$( '.dropdown-toggle' ).click( function( e ) {
		var _this = $( this );
		e.preventDefault();
		_this.toggleClass( 'toggle-on' );
		_this.parent().next( '.sub-menu' ).toggleClass( 'toggled-on' );
		_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		_this.html( _this.html() === '<span class="screen-reader-text">Expand child menu</span>' ? '<span class="screen-reader-text">Collapse child menu</span>' : '<span class="screen-reader-text">Expand child menu</span>' );
	} );

})( jQuery );



$(document).ready(function () {
	$('#search_field').on('keyup',function (e) {

		//requête ajax
		$.ajax({
			url:'http://127.0.0.15/projet_web/projet_web/projetWebE_Commerce/serverSearch.php',
			type:'POST',
			data:{search_field:e.target.value},
			success:function (res) {

				$('#data').html(res);


			},
			error:function (err) {
				console.error(err.message)
			}
		})
	})
});