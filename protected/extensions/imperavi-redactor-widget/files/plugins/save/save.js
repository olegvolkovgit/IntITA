if (!RedactorPlugins) var RedactorPlugins = {};

(function($)
{
	RedactorPlugins.save = function()
	{
		return {
			init: function()
			{
				var button = this.button.add('save', this.lang.get('saveB'));

				// make your added button as Font Awesome's icon
				this.button.setAwesome('save', 'fa-save');

				this.button.addCallback(button, this.save.sendContent);

			},
			sendContent: function()
			{
				var html = this.code.get();

                $.ajax({
                    cache: false,
                    type: "POST",
                    url: '/revision/saveBlock',
                    data: {'content':html,'idLecture':idLecture,'order':order.substring(2)}
                });
			}
		};
	};
})(jQuery);