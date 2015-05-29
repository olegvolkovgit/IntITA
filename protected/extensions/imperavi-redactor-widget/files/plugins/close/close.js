/**
 * Created by Ivanna on 29.05.2015.
 */
if (!RedactorPlugins) var RedactorPlugins = {};

(function($)
{
    RedactorPlugins.close = function()
    {
        return {
            init: function()
            {
                var button = this.button.add('close', 'Close');

                // make your added button as Font Awesome's icon
                this.button.setAwesome('close', 'fa-times');

                this.button.addCallback(button, this.close.testButton);
            },
            testButton: function(buttonName)
            {
                this.core.destroy();
            }
        };
    };
})(jQuery);
