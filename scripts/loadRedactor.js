/**
 * Created by Ivanna on 07.05.2015.
 */
function loadRedactor(order)
{
    $(order).redactor({
        iframe: true,
        focus: true,
        plugins: ['video','advanced'],
        startCallback: function()
        {
            var marker = this.selection.getMarker();
            this.insert.node(marker);
        },
        initCallback: function()
        {
            this.selection.restore();
            $(order).off('click', loadRedactor(order));
        },
        destroyCallback: function()
        {
            console.log('destroy');
            $(order).on('click', loadRedactor(order));
        }
    });

}