(function($, undefined) {
	var settingsChanged = false, hasTitle = false, hasShortcode = false, editImage = false;
	
	$(document).ready(function() {
		// INIT
		init_tabs();
		init_radio_groups();
		init_yellow_fade();
		form_inline_validation();
		validate_form();
		form_interactivity();
		preview_tab_warning();
	});
	
	// Init functions
	
	function init_tabs() {
		if ($('.ndd-tab-group').length == 0) return;
		
		var listItems = $('.ndd-tab-group > ul li');
		var tabs = $('.ndd-tab-group > .ndd-tab');
		
		var c = 0;
		listItems.each(function() {
			$(this).attr('id', 'ndd-tab-title-' + c);
			c++;
		});
		
		c = 0;
		tabs.each(function() {
			$(this).attr('id', 'ndd-tab-content-' + c);
			c++;
		});
		
		$('.ndd-tab-group > ul li').on('click', function() {
			listItems.removeClass('active');
			tabs.removeClass('active');
			
			$(this).addClass('active');
			var id = $(this).attr('id').replace('ndd-tab-title-', '');
			$('#ndd-tab-content-' + id).addClass('active');
		});
	}
	function init_radio_groups() {
		if ($('.ndd-radio-group').length == 0) return;
		
		var ctrl = false;
		
		$('.ndd-radio-group > ul li').on('click', function() {
			if (!ctrl || $(this).closest('.ndd-select-multiple').length == 0) {
				$(this).siblings('.active').removeClass('active');
			}
			$(this).addClass('active');
		});
		
		$(document).on('keydown', function(e) {
			if (e.which == 16) {
				ctrl = true;
			}
		});
		$(document).on('keyup', function(e) {
			ctrl = false;
		});
	}
	function init_yellow_fade() {
		$('.ndd-new-row').addClass('ndd-new-row-animate');
		setTimeout(function() {
			$('.ndd-new-row').removeClass('ndd-new-row-animate').removeClass('ndd-new-row');
		}, 2000);
	}
	
	function go_to_tab(tabWrap) {
		// Show tab
		$('.ndd-tab').not(tabWrap).removeClass('active');
		tabWrap.addClass('active');
		
		// Switch active states
		$('.ndd-tab-group ul li').removeClass('active');
		var id = tabWrap.attr('id').replace('ndd-tab-content-', '');
		$('#ndd-tab-title-' + id).addClass('active');
	}
	function show_error_for(field, message) {
		field.addClass('ndd-has-error');
		field.closest('tr').addClass('ndd-error-row');
		field.siblings('.ndd-error-field').remove();
		field.after('<div class="ndd-error-field">' + message + '</div>');
	}
	function remove_error_for(field) {
		if (!field.hasClass('ndd-has-error')) return;
		field.removeClass('ndd-has-error');
		field.closest('tr').removeClass('ndd-error-row');
		field.next().remove();
	}
	function form_inline_validation() {
		var title = /^[A-Za-z0-9_ ]{3,20}$/;
		var shortcode = /^[A-Za-z0-9_]{3,20}$/;
		
		$('#show_on').on('change', function() {
			// settingsChanged = true;
		});
		
		$('#title').on('change', function() {
			if (!title.test($(this).val())) {
				show_error_for($(this), 'Please enter between 3 and 20 alphabets or numbers. Spaces are allowed. No special characters except underscore("_").');
			} else {
				remove_error_for($(this));
			}
			
			// settingsChanged = true;
		});
		$('#shortcode').on('change', function() {			
			if (!shortcode.test($(this).val())) {
				show_error_for($(this), 'Please enter between 3 and 20 alphabets or numbers. No spaces. No special characters except underscore("_").');
			} else {
				remove_error_for($(this));
			}
			
			// settingsChanged = true;
		});
		
		$('input, textarea, select').on('change', function() {
			settingsChanged = true;
		});
		$('#hb-map-wrap').on('mousedown', function() {
			settingsChanged = true;
		});
	}
	function validate_form() {
		$('#save_options').on('click', function(e) {
			// e.preventDefault();
			// return false;
			window.update_json();
			// return false;
			if (!$('#shortcode').val()) {
				show_error_for($('#shortcode'), 'Please enter between 3 and 20 alphabets or numbers. Spaces are allowed. No special characters except underscore("_").');
				
				if (!$('#title').val()) {
					show_error_for($('#title'), 'Please enter between 3 and 20 alphabets or numbers. Spaces are allowed. No special characters except underscore("_").');
					e.preventDefault();
					// return false;
				} else {
					remove_error_for($(this));
				}
				
				e.preventDefault();
				// return false;
			} else {
				remove_error_for($(this));
			}
			
			if (!$('#title').val()) {
				show_error_for($('#title'), 'Please enter between 3 and 20 alphabets or numbers. Spaces are allowed. No special characters except underscore("_").');
				e.preventDefault();
				// return false;
			} else {
				remove_error_for($(this));
			}
			if ($('.ndd-has-error').length != 0) {
				go_to_tab($('.ndd-has-error').first().closest('.ndd-tab'));
				$('.as .updated').remove();
				$('.as header').append('<div class="error">There was an error validating the settings!</div>');
				
				e.preventDefault();
				return false;
			}
		});
	}
	function form_interactivity() {
		$('.hb-change-image').on('click', function() {
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			return false;
		});
		$('#new-image-url').on('change', function() {
			if ($('#hb-map-wrap').find('img').length != 0) {
				$('#hb-map-wrap').find('img').attr('src', $(this).val());
				$('#imgurl').attr('value', $(this).val());
			} else {
				add_new_image($(this).val());
			}
			window.initEditor();
		});
	}
	function preview_tab_warning() {
		$('.preview-tab').on('click', function() {
			if (settingsChanged) {
				$('.preview-tab-c').prepend('<div class="greetings">Oops! You need to save before the changes can take effect!</div>');
			}
		});
	}
	
	// Thickbox
	function add_new_image(url) {
		imgwrap = $('#hb-map-wrap');
		
		imgwrap.html('<img src="' + url + '">');
		imgwrap.off('.add_image_event');
		imgwrap.removeClass('noimage');
		
		$('#imgurl').attr('value', url);
		window.initEditor();
	}
	window.send_to_editor = function(html) {
		imgurl = $('img', html).attr('src');
		if (editImage != false) {
			editImage.attr('src', imgurl);
			center_image(editImage);
			editImage = false;
		} else {
			add_new_image(imgurl);
		}
		tb_remove();
	}
	
	
	// Utility
	function isNumeric(num) {
	    return !isNaN(num);
	}
	
})(jQuery);