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
				$('#formulaBox').remove();
				this.core.destroy();
			}
		};
	};
})(jQuery);