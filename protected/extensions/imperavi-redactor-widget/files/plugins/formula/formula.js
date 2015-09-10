if (!RedactorPlugins) var RedactorPlugins = {};

(function($)
{
    RedactorPlugins.formula = function()
    {
        return {
            init: function()
            {
                var button = this.button.add('formula', this.lang.get('formula'));

                // make your added button as Font Awesome's icon
                this.button.setAwesome('formula', 'fa-formula');

                this.button.addCallback(button, this.formula.sendContent);

            },
            sendContent: function() {
                id = "toolbar" + order;
                alert(id);
                document.getElementById('formulaContainer').focus();
                $(document).ready(function () {
                    EqEditor.embed(id, '', 'full', 'uk-uk');
                    var a = new EqTextArea('equation', 'formulaContainer');
                    EqEditor.add(a, false);
                    document.getElementById(id).style.display = 'block';
                })
            }
        };
    };
})(jQuery);