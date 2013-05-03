jQuery(document).ready(function($){

	var page = 2,
		searching = false,
		loader = $('.loader'),
		showmorecontainer = $('.showmore'),
		showmorebutton = $('.showmore span'),
		url = '/beta/magazine/',
		currentContent = null,
		showingContentFor = 'Everything',
		filterButton = $('.magazine-article-type a');
		
		filterButton.click(function(e){
			e.preventDefault();
			
			if(showingContentFor != $(this).html())
			{
				page = 1;
				url = $(this).attr('href');
				showingContentFor = $(this).html();
				
				$('.middle').height($('.articles').height());
				
				$('.articles').fadeOut('normal', function(){
						$(this).remove();
					});
				
				getContent();
			}
			
		});
	
	
	showmorebutton.click(function (e) {
  		e.preventDefault();
  		
  		if(!searching)
  		{
  			searching = true;
  			
  			showmorecontainer.fadeOut('normal', function(){
				loader.fadeIn();
  			});
  			
  			getContent();
		}
	});

	
	getContent = function(){
		
		$.ajax({
				url: url + '?page=' + page,
    			success: function(result){
    				
    				// get our content
    				currentContent = $(result).find(".articles");
    				
    				if(currentContent.length >= 10)	// there's content
    				{
    					// add our content
    					currentContent.css('display', 'none').appendTo($('.middle')).fadeIn();
    					
    					$('.middle').height($('.articles').height());
    					
    					// fade our showmore button back in
    					loader.fadeOut('normal', function(){
								showmorecontainer.fadeIn();
  						});
    					
    					// set searching back to false
    					searching = false;
    					
    					// increase our page count
    					page++;		
					}
					else if(currentContent.length < 10)	// there's content
    				{
    					// add our content
    					currentContent.css('display', 'none').appendTo($('.middle')).fadeIn();
    					
    					$('.middle').height($('.articles').height());
    					
    					// fade our showmore button back in
    					loader.fadeOut('normal');
    					
    					// set searching back to false
    					searching = false;
    					
    					// increase our page count
    					page++;		
					}
					else
					{
						loader.fadeOut('normal');
					}	
				}
			});
	}
	
});