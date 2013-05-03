jQuery(document).ready(function($){
	
	$(".gallery").each(function(){
		$(this).carousel();
	});
	
	$('#myTab a').click(function (e) {
  		e.preventDefault();
  		$(this).tab('show');
	});

	$('.collection-products').each(function(){
		$(this).tooltip();
	});


    $('.nav-list').localScroll({offset: {top: -100, left: 0}});
	
	$('.nav-tabs a').click(function(){
		$('html, body').animate({scrollTop: $('.middle').offset('500').top}, 500);
	});
});