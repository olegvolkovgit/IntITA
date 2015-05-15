if (!RedactorPlugins) var RedactorPlugins = {};

(function($)
{
	RedactorPlugins.save = function()
	{
		return {
			init: function()
			{
				var button = this.button.add('save', 'Save');
	 
				// make your added button as Font Awesome's icon
				this.button.setAwesome('save', 'fa-save');
	 
				this.button.addCallback(button, this.save.testButton);
			},
			testButton: function(buttonName)
			{
				this.core.destroy();
			}
		};
	};
})(jQuery);