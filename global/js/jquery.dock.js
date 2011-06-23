/*
Apple Dock jQuery plugin
By Herman van der Maas, 28-9-2010, waywayway.nl
Dedicated to Benjamin Paap, benjaminpaap.de
This plugin works on a <div> containing <img>'s that are optionally wrapped in <a>'s
All <img>'s must have the same size, if not they will be resized to the size of the first <img>
In the html document, first include the .js file of jQuery 1.4.2, then this .js plugin file, then a .js script attaching the dock method to your <div>
*/

(function($) {
	$.fn.dock = function(settings) {

		// The config object contains default settings
		var config = {
			// zoomFactor is a percentage of magnification e.g. 1.00 is no zooming, 2.00 = 200%
			zoomFactor : 2.00,
			// zoomWidth is the width of the magnification of the <img>'s
			zoomWidth : 90,
			// timeOut is the time (in milliseconds) that elapses between the mouseout and the sliding back of the <div id="dock">
			timeOut : 700
		};

		// Merge the user settings object with the config object
		if (settings) $.extend(config, settings);
		// Put <div id="dock"> in a jQuery object, let the variable name start with a "$" to indicate a jQuery object
		$dock = $(this);
		// put all <img>'s in a jQuery object for future calculations
		$images = $(this).find('img');

		// apply the functions + return each element in the jQuery selection to maintain chainability
		return this.each(function() {
			// Put original <img>'s margin-top property in variable
			originalMargintop = $images.eq(0).css('margin-top');
			// Put original <img>'s width in variable
			originalImgwidth = $images.eq(0).width();

			initDockslide();

			// Create slide in / slide out of Dock <div>
			function initDockslide() {
				// variable below must be available to other functions (it must have global scope), so no "var" keyword to declare it
				originalBottomposition = $dock.css('bottom');
				originalDivwidth = $dock.width();
				originalDivposition = - parseInt($dock.css('margin-left').replace(/[^\d\.]/g, ''));
				t = '';
				$dock.hover(slideDockin, slideDockout);
			};

			function slideDockin() {
				if(t) {
					clearTimeout(t);
				};
				// the keyword "this" refers to the "hovered" element (the <div> with <img>'s)
				$(this).animate({bottom : "0px"}, 500, initZoom);
			};

			function slideDockout() {
				exitZoom();
				var timerCallback = function() {
					$dock.animate({bottom : originalBottomposition}, 400);
					// unbind "mousemove" event from <div>
					$dock.unbind('mousemove');
				};
				t = setTimeout(timerCallback, config.timeOut);
			};

			// Start zooming in on images in <div> when mouse moves
			function initZoom(){
				// if mouse moves over <div>, zoom in on images
				$dock.bind('mousemove', zoom);
			};

			function zoom(e){
				// zoom in on images
				$images.each(function() {
					// .replace(/[^\d\.]/g, '') deletes the css unit (e.g. '20px' becomes 20)
					var currentImgWidth = $(this).css('width').replace(/[^\d\.]/g, '');
					var currentImgX = $(this).offset().left + (currentImgWidth / 2);
					var differenceX = currentImgX - e.pageX;
					var zoomMultiplier = 1 + (config.zoomFactor - 1) * Math.pow(10, (-0.5 * Math.pow((differenceX / config.zoomWidth) ,2)));
					var newWidth = Math.round(zoomMultiplier * originalImgwidth);
					var newHeight = newWidth;
					// calculate new "margin-top" css property
					var newMargintop = - Math.round(newWidth - originalImgwidth) + parseInt(originalMargintop.replace(/[^\d\.]/g, ''));
					if (newWidth != currentImgWidth) {
						$(this).css({
							"margin-top" : newMargintop + 'px',
							width : newWidth + 'px',
							height : newHeight + 'px'
						});
					}
				});
				// adjust position of <div id="dock">
				newMarginleft = originalDivposition + (originalDivwidth - $dock.width()) / 2;
				if (Math.abs(originalDivwidth - $dock.width()) > 5) {
					$dock.css({'margin-left' : newMarginleft + 'px'});
				};
			};

			// Stop zooming in
			function exitZoom(){
				$dock.animate({
					'margin-left' : originalDivposition
				}, 150);
				$images.each(function() {
					$(this).animate({
						width : originalImgwidth,
						height : originalImgwidth,
						'margin-top' : originalMargintop
					}, 150);
				});
			};
		});
	};
})(jQuery);