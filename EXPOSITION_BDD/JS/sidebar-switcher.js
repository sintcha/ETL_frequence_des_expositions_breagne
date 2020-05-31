( function( $ ) {
    
    
    $('a.sidebar-left-toggle').click(function(){
		if(!$('.sidebar').hasClass('sidebar-left')){
			$('.sidebar').addClass('sidebar-left');
		}
	});
	
	$('a.sidebar-right-toggle').click(function(){
		if($('.sidebar').hasClass('sidebar-left')){
			$('.sidebar').removeClass('sidebar-left');
		}
	});
	
	$('a.no-sidebar-toggle').click(function(){
		$('.content').toggleClass('no-sidebar');
	});
	
	$('a.hide-sidebar-toggle').click(function(){
		$('.sidebar').toggleClass('hide-sidebar');
	});
})( jQuery );








