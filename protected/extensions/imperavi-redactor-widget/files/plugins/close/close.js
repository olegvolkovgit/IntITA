if (!RedactorPlugins) var RedactorPlugins = {};

(function($)
{
	RedactorPlugins.close = function()
	{
		return {
			init: function()
			{
				var button = this.button.add('close', this.lang.get('close'));

				// make your added button as Font Awesome's icon
				this.button.setAwesome('close', 'fa-times');

				this.button.addCallback(button, this.close.testButton);
			},
			testButton: function(buttonName)
			{
				var id = "#toolbar" + order.substr(1);
				$(id).hide();
				$('#formulaBox').remove();
				$(".redactor-editor").removeAttr("data-target");
				$(order).removeAttr('data-flag');
				this.core.destroy();
			}
		};
	};
})(jQuery);