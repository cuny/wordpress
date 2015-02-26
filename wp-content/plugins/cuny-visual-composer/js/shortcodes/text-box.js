(function ($) {
	window.CUNYTextBox = vc.shortcode_view.extend({
		changeShortcodeParams:function (model) {
			var params = model.get('params');
      var $wrapper = this.$el.find('> .wpb_element_wrapper');
      var classes = [];
console.log(params);
      classes.push("cuny_text_" + params.color);
      $wrapper.addClass(classes.join(' '));

      window.CUNYTextBox.__super__.changeShortcodeParams.call(this, model);
		}
	});
})(window.jQuery);