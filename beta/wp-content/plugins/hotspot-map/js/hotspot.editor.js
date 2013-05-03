(function ($, undefined) {
	
	var wrap = 0, wrapOffsetX = 0, wrapOffsetY = 0, spots = new Array();
	var spotID = 0;
	var targetObj = 0;
	var mx = 0, my = 0, mox = 0, moy = 0, mix = 0, miy = 0, ix = 0, iy = 0, ox = 0, oy = 0, iw = 0, ih = 0;
	var cx = 0, cy = 0, cw = 0, ch = 0; // containerX, containerY, containerWidth, containerHeight
	var mouseDown = false, startedDrawing = false, drawing = false, tooltipVisible = false, startMoving = false, moving = false, startScaling = false, scaling = false;
	var scaleHandle = '', moveHandle = '';
	var tooltip = ''; // element reference
	var selectedSpot = undefined;

	function Spot(x, y) {
		this.id = spotID;
		this.type = 'spot';
		this.x = x;
		this.y = y;
		this.html = '<div class="hb-spot hb-spot-object" id="hb-spot-' + this.id + '"><div class="hb-tooltip-wrap"><div class="hb-tooltip"></div></div></div>';
		this.root = '';
		this.width = 30;
		this.height = 30;
		
		this.settings = { "visible" : "visible", "show_on" : "mouseover", "popup_position" : "left", "content" : "", "tooltip_width" : 200, "tooltip_auto_width" : true };
		
		spotID++;
	}
	Spot.prototype.init = function() {
		wrap.append(this.html);
		this.root = $('#hb-spot-' + this.id);
		
		this.root.css({ "left" : this.x, "top" : this.y, "width" : this.width, "height" : this.height, "margin-left" : -this.width/2, "margin-top" : -this.height/2 });
		
		this.apply_settings();
	}
	Spot.prototype.start_moving = function() {
		ix = this.x;
		iy = this.y;
	}
	Spot.prototype.move = function() {
		this.x = (ix + mox + this.width/2 > cw) ? cw - this.width/2 : (ix + mox - this.width/2 < 0) ? this.width/2 : ix + mox;
		this.y = (iy + moy + this.height/2 > ch) ? ch - this.height/2 : (iy + moy - this.height/2 < 0) ? this.height/2 : iy + moy;
		
		this.root.css({
			"left" : this.x,
			"top" : this.y
		});
	}
	Spot.prototype.select = function() {
		enable_form();
		$('.hb-spot-object.selected').removeClass('selected');
		this.root.addClass('selected');
		
		selectedSpot = this;
		update_settings();
	}
	Spot.prototype.del = function() {
		this.deselect();
		disable_form();
		
		this.root.remove();
		spots[this.id] = null;
	}
	Spot.prototype.deselect = function() {
		this.root.removeClass('selected');
		selectedSpot = undefined;
	}
	Spot.prototype.apply_settings = function() {
		this.root.removeClass('left').removeClass('top').removeClass('bottom').removeClass('right').removeClass('mouseover').removeClass('always').removeClass('click').removeClass('visible').removeClass('invisible');
		
		this.root.addClass(this.settings['popup_position']);
		this.root.addClass(this.settings['show_on']);
		this.root.addClass(this.settings['visible']);
		this.root.find('.hb-tooltip').html(this.settings['content']);
		
		if (!this.settings['tooltip_auto_width']) {
			this.root.find('.hb-tooltip-wrap').css({ 'width' : this.settings['tooltip_width'] });
		} else {
			this.root.find('.hb-tooltip-wrap').css({ 'width' : 'auto' });
		}
		
		// update_json();
	}
	
	function Rectangle_Spot(x, y) {
		this.id = spotID;
		this.type = 'rect';
		this.x = x;
		this.y = y;
		this.width = 0;
		this.height = 0;
		this.html = '<div class="hb-rect-spot hb-spot-object" id="hb-spot-' + this.id + '"><div class="hb-tooltip-wrap"><div class="hb-tooltip"></div></div></div>';
		this.root = '';
		
		this.success = true;
		this.settings = { "visible" : "invisible", "show_on" : "mouseover", "popup_position" : "left", "content" : "", "tooltip_width" : 200, "tooltip_auto_width" : true };
		
		spotID++;
	}
	Rectangle_Spot.prototype.load = function(width, height) {
		this.init();
		this.width = width;
		this.height = height;
		this.root.append(scaleHandle);
		this.root.append(moveHandle);
		
		this.root.css({
			"width" : this.width,
			"height" : this.height
		});
	}
	Rectangle_Spot.prototype.init = function() {
		wrap.append(this.html);
		this.root = $('#hb-spot-' + this.id);
		this.root.css({ "left" : this.x, "top" : this.y });
		
		this.apply_settings();
	}
	Rectangle_Spot.prototype.draw = function() {
		this.width = (mox < 16) ? 16 : mox;
		this.height = (moy < 16) ? 16 : moy;
		
		
		// Constrain to edges of the container
		this.width = (this.width + this.x > cw) ? cw - this.x : this.width;
		this.height = (this.height + this.y > ch) ? ch - this.y : this.height;
		
		this.root.css({ "width" : this.width, "height" : this.height });
	}
	Rectangle_Spot.prototype.end_drawing = function() {
		this.root.append(scaleHandle);
		this.root.append(moveHandle);
		
		if (this.width < 16 && this.height < 16) {
			this.success = false;
		}
	}
	Rectangle_Spot.prototype.release = function() {
		this.root.remove();
		spotID--;
	}
	Rectangle_Spot.prototype.start_moving = function() {
		ix = this.x;
		iy = this.y;
	}
	Rectangle_Spot.prototype.move = function() {
		this.x = (ix + mox + this.width > cw) ? cw - this.width : (ix + mox < 0) ? 0 : ix + mox;
		this.y = (iy + moy + this.height > ch) ? ch - this.height : (iy + moy < 0) ? 0 : iy + moy;

		this.root.css({
			"left" : this.x,
			"top" : this.y
		});
	}
	Rectangle_Spot.prototype.start_scaling = function() {
		iw = this.width;
		ih = this.height;
	}
	Rectangle_Spot.prototype.scale = function() {
		this.width = (iw + mox < 16) ? 16 : iw + mox;
		this.height = (ih + moy < 16) ? 16 : ih + moy;
		
		// Constrain to edges of the container
		this.width = (this.width + this.x > cw) ? cw - this.x : this.width;
		this.height = (this.height + this.y > ch) ? ch - this.y : this.height;

		this.root.css({
			"width" : this.width,
			"height" : this.height
		});
	}
	Rectangle_Spot.prototype.select = function() {
		enable_form();
		$('.hb-spot-object.selected').removeClass('selected');
		this.root.addClass('selected');
		
		selectedSpot = this;
		update_settings();
	}
	Rectangle_Spot.prototype.del = function() {
		this.deselect();
		disable_form();
		
		this.root.remove();
		spots[this.id] = null;
	}
	Rectangle_Spot.prototype.deselect = function() {
		this.root.removeClass('selected');
		selectedSpot = undefined;
	}
	Rectangle_Spot.prototype.apply_settings = function() {
		this.root.removeClass('left').removeClass('top').removeClass('bottom').removeClass('right').removeClass('always').removeClass('mouseover').removeClass('click').removeClass('visible').removeClass('invisible');
		
		this.root.addClass(this.settings['popup_position']);
		this.root.addClass(this.settings['show_on']);
		this.root.addClass(this.settings['visible']);
		this.root.find('.hb-tooltip').html(this.settings['content']);
		
		if (!this.settings['tooltip_auto_width']) {
			this.root.find('.hb-tooltip-wrap').css({ 'width' : this.settings['tooltip_width'] });
		} else {
			this.root.find('.hb-tooltip-wrap').css({ 'width' : 'auto' });
		}
		
	}
	
	$(document).ready(function() {
		window.initEditor = function() {
			if ($('#hb-map-wrap img').length != 0) {
				init();
				init_events();
				form_action();
				disable_form();
			}
		}
		
		$('#ndd-tab-title-2').on('click', function() {
			window.initEditor();
		});
		window.update_json = function() {
			var newspots = new Array(), len = spots.length, j = 0;

			for (i=0; i<len; i++) {
				if (spots[i] != undefined) {
					newspots[j] = spots[i];
					newspots[j].root = undefined;
					j++;
				}
			}

			$('#spots-json').html(JSON.stringify(newspots));
		}
	});
	
	function init() {
		spotID = 0;
		wrap = $('#hb-map-wrap');
		cx = wrap.offset().left;
		cy = wrap.offset().top;
		
		var img = new Image();
		img.src = wrap.find('img').attr('src');

		if (!img.complete) {
			img.onload = function() {
				cw = wrap.width();
				ch = wrap.height();
			}
		} else {
			cw = wrap.width();
			ch = wrap.height();
		}
		
		scaleHandle = '<div class="hb-scale-handle"></div>';
		moveHandle = '<div class="hb-move-handle"></div>';
		
		$('body').prepend('<div id="hb-help-tooltip"></div>');
		tooltip = $('#hb-help-tooltip');
		
		if ($('#spots-json').val()) {
			rebuild_objects();
		}
	}
	function rebuild_objects() {
		var js = $('#spots-json').html(), i = 0, html = '', tmp = 0;
		spots = $.parseJSON(js);
		
		var len = spots.length;
		for (i=0; i<len; i++) {
			if (spots[i].type == 'spot') {
				tmp = new Spot(spots[i].x, spots[i].y);
				tmp.settings = spots[i].settings;
				tmp.init();
				spots[i] = tmp;
			} else {
				tmp = new Rectangle_Spot(spots[i].x, spots[i].y);
				spots[i].settings.content = spots[i].settings.content.replace(/&lt;/g, '<');
				spots[i].settings.content = spots[i].settings.content.replace(/&gt;/g, '>');
				tmp.settings = spots[i].settings;
				tmp.load(spots[i].width, spots[i].height);
				spots[i] = tmp;
			}
		}
		dynamic_events();
	}
	function init_events() {
		wrap.on('mousedown', function(e) {
			if ($(e.target).hasClass('hb-scale-handle')) {
				startScaling = true;
				targetObj = spots[$(e.target).closest('.hb-spot-object').attr('id').replace('hb-spot-', '')];
				return false;
			}
			if ($(e.target).hasClass('hb-move-handle')) {
				startMoving = true;
				targetObj = spots[$(e.target).closest('.hb-spot-object').attr('id').replace('hb-spot-', '')];
				return false;
			}
			if ($(e.target).hasClass('hb-spot')) {
				startMoving = true;
				targetObj = spots[$(e.target).attr('id').replace('hb-spot-', '')];
				return false;
			}
			if ($(e.target).closest('.hb-spot-object').length == 0 && !$(e.target).hasClass('hb-spot-object')) {
				mouseDown = true;
				return false;
			}
		});
		$(document).on('mousemove', function(e) {
			
			mx = e.pageX;
			my = e.pageY;

			mox = mx - mix;
			moy = my - miy;
			
			// ============= TOOLTIP =============
			if (tooltipVisible) {
				update_tooltip();
			}
			
			if (targetObj === undefined) {
				return;
			}
			
			
			// ============= SCALE =============
			if (startScaling) {
				mix = mx;
				miy = my;
				
				startScaling = false;
				scaling = true;
				
				targetObj.start_scaling();
				return;
			}			
			if (scaling) {
				targetObj.scale();
				return;
			}
			
			// ============= MOVE =============
			if (startMoving) {
				mix = mx;
				miy = my;
				
				startMoving = false;
				moving = true;
				
				targetObj.start_moving();
				return;
			}

			if (moving) {
				targetObj.move();
				return;
			}
			
			// ============= DRAW =============
			if (mouseDown && !startedDrawing) {
				mix = mx;
				miy = my;
				
				targetObj = new Rectangle_Spot(mx - cx, my - cy);
				targetObj.init();
				
				startedDrawing = true;
				drawing = true;
				return;
			}
			
			if (drawing) {
				targetObj.draw();
				return;
			}
			
			update_tooltip();
		});
		$(document).on('mouseup', function(e) {

			if (moving || scaling || startMoving || startScaling) {
				moving = false;
				scaling = false;
				startMoving = false;
				startScaling = false;
				
				// update_json();
				return;
			}
			
			if (startedDrawing) {
				targetObj.end_drawing();
				if (targetObj.success) {
					// Prevents too small rectangles. Pretty much useless, having in mind the "Spot" class.
					spots.push(targetObj);
					dynamic_events();
				} else {
					targetObj.release();
				}
				// update_json();
				startedDrawing = false;
				drawing = false;
			} else {
				if (($(e.target).attr('id') == 'hb-map-wrap' || $(e.target).closest('#hb-map-wrap').length != 0) && mouseDown) {
					targetObj = new Spot(mx - cx, my - cy);
					spots[spotID - 1] = targetObj;
					targetObj.init();
					dynamic_events();
					// update_json();
				}
			}
			
			mouseDown = false;			
		});
	}
	function dynamic_events() {
		$('.hb-scale-handle, .hb-move-handle, .hb-spot, .hb-spot-object').off('.hb');
		
		$('.hb-scale-handle').on('mouseover.hb', function() {
			show_tooltip('scale');
		});
		$('.hb-scale-handle').on('mouseout.hb', function() {
			hide_tooltip();
		});
		$('.hb-move-handle').on('mouseover.hb', function() {
			show_tooltip('move');
		});
		$('.hb-move-handle').on('mouseout.hb', function() {
			hide_tooltip();
		});
		$('.hb-spot').on('mouseover.hb', function() {
			show_tooltip('move');
		});
		$('.hb-spot').on('mouseout.hb', function() {
			hide_tooltip();
		});
		$('.hb-spot-object').on('mouseup.hb', function() {
			$(this).toggleClass('visible-tooltip');
			spots[$(this).attr('id').replace('hb-spot-', '')].select();
		});
	}
	function show_tooltip(text) {
		tooltip.html(text);
		tooltip.show();
		tooltip.css({ "left" : mx + 15, "top" : my + 15 });
		
		tooltipVisible = true;
	}
	function update_tooltip() {
		tooltip.css({ "left" : mx + 15, "top" : my + 15 });
	}
	function hide_tooltip() {
		tooltip.hide();
		
		tooltipVisible = false;
	}
	function update_settings() {
		$('#visible-select').val(selectedSpot.settings['visible']);
		$('#position-select').val(selectedSpot.settings['popup_position']);
		$('#content').val(selectedSpot.settings['content']);
		
		if (selectedSpot.settings['tooltip_auto_width']) {
			$('#tooltip-auto-width').attr('checked', 'checked');
			$('#tooltip-width').attr('disabled', 'disabled').val(selectedSpot.settings['tooltip_width']);
		} else {
			$('#tooltip-auto-width').removeAttr('checked');
			$('#tooltip-width').removeAttr('disabled').val(selectedSpot.settings['tooltip_width']);
		}
	}
	function form_action() {
		$('#visible-select').on('change', function() {
			if (selectedSpot) {
				selectedSpot.settings['visible'] = $(this).val();
				selectedSpot.apply_settings();
			}
		});
		$('#position-select').on('change', function() {
			if (selectedSpot) {
				selectedSpot.settings['popup_position'] = $(this).val();
				selectedSpot.apply_settings();
			}
		});
		$('#content').on('change', function() {
			if (selectedSpot) {
				selectedSpot.settings['content'] = $(this).val();
				selectedSpot.apply_settings();
			}
		});
		$('#delete').on('click', function() {
			if (selectedSpot) {
				spots[selectedSpot.id] = undefined;
				selectedSpot.del();
			}
		});
		$('#tooltip-auto-width').on('change', function() {
			if ($(this).attr('checked')) {
				$('#tooltip-width').attr('disabled', 'disabled');
				selectedSpot.settings['tooltip_auto_width'] = true;
			} else {
				$('#tooltip-width').removeAttr('disabled');
				selectedSpot.settings['tooltip_auto_width'] = false;
			}
			selectedSpot.settings['tooltip_width'] = parseInt($('#tooltip-width').val().replace('px', ''));
			selectedSpot.apply_settings();
		});
		$('#tooltip-width').on('change', function() {
			selectedSpot.settings['tooltip_width'] = parseInt($('#tooltip-width').val().replace('px', ''));
			selectedSpot.apply_settings();
		});
	}
	function disable_form() {
		$('#hb-settings-wrap').find('input, textarea, select').attr('disabled', 'disabled');
	}
	function enable_form() {
		$('input, textarea, select').not('#tooltip-width').removeAttr('disabled');
		
		if ($('#tooltip-auto-width').attr('checked')) {
			$('#tooltip-width').attr('disabled', 'disabled');
		}
	}
	function update_json() {
		var newspots = new Array(), len = spots.length, j = 0;
		
		for (i=0; i<len; i++) {
			if (spots[i] != undefined) {
				newspots[j] = spots[i];
				newspots[j].root = undefined;
				j++;
			}
		}

		$('#spots-json').html(JSON.stringify(newspots));
	}
}(jQuery));