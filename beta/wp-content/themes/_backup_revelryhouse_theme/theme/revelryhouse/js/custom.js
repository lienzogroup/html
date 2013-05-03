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
	
	
	$('.nav-list').localScroll();
});