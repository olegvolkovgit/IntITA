if (!RedactorPlugins) var RedactorPlugins = {};

(function($)
{
    RedactorPlugins.formula = function()
    {
        return {
            init: function()
            {
                var button = this.button.add('formula', this.lang.get('saveB'));

                // make your added button as Font Awesome's icon
                this.button.setAwesome('formula', 'fa-formula');

                this.button.addCallback(button, this.formula.sendContent);

            },
            sendContent: function()
            {
                OpenLatexEditor('newFormula','latex','uk_uk', 'true');
            }
        };
    };
})(jQuery);