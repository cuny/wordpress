jQuery(document).ready(function($) {
	"use strict";

	$('.cuny-carousel').each(function(){
		$(this).slick({
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
	  	slidesToShow: $(this).data('items'),
	  	slidesToScroll: 1,

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
});