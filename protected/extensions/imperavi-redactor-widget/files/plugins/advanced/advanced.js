if (!RedactorPlugins) var RedactorPlugins = {};

(function($)
{
	RedactorPlugins.advanced = function()
	{
		return {
			init: function()
			{
				var button = this.button.add('advanced', 'Advanced');
	 
				// make your added button as Font Awesome's icon
				this.button.setAwesome('advanced', 'fa-times');
	 
				this.button.addCallback(button, this.advanced.testButton);
			},
			testButton: function(buttonName)
			{
				this.core.destroy();
			}
		};
	};
})(jQuery);