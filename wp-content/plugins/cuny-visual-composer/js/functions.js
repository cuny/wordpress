jQuery(document).ready(function($) {
	"use strict";

	$('.cuny-carousel').each(function(){
		if (typeof $(this).slick != 'function'){
			return false;
		}

		$(this).slick({
			autoplay: (parseInt($(this).data('autoplay')) > 0) ? true : false,
  		autoplaySpeed: $(this).data('autoplay'),
		  infinite: true,
		  refresh: true,
		  responsive: [
		    {
		      breakpoint: 1199,
		      settings: {
		        slidesToShow: (parseInt($(this).data('items')) != 6)?(parseInt($(this).data('items')) - 1) : 4
		      }
		    },
		    {
		      breakpoint: 959,
		      settings: {
		        slidesToShow: 2
		      }
		    },
		    {
		      breakpoint: 756,
		      settings: {
		        slidesToShow: 1
		      }
		    }
		  ],
		  slide: $(this).data('slide-container'),
	  	slidesToShow: parseInt($(this).data('items')),
	  	slidesToScroll: parseInt($(this).data('items-to-scroll')),

	  	onSetPosition: function(slider){
	  		var carousel_width = parseInt(slider.$slider.css('width'));
	  		var carousel_visible_items = this.options.slidesToShow;
	  		var gutter_width = parseInt(slider.$slider.find('.slick-slide.slick-active:first').css('margin-left'));

	  		var item_width_adjusted = parseInt((carousel_width - parseInt(gutter_width * (carousel_visible_items - 1))) / carousel_visible_items);
	  		slider.$slider.find('.slick-slide').each(function(){
	  			$(this).css('width', item_width_adjusted + 'px');
	  		});
	  	},
	  	variableWidth: true
		});
	});

	$('.expandable-more-link').click(function(e){
		e.preventDefault();

		if (typeof $(this).data('alt-title') != 'undefined'){
			var temp = $(this).html();
			$(this).html($(this).data('alt-title'));
			$(this).data('alt-title', temp);
		}

		$(this).toggleClass('expandable-more-link-open').toggleClass('expandable-more-link-closed');

		var target = '.' + $(this).data('expand-target-element');
		$(target).slideToggle('fast');
	});
});