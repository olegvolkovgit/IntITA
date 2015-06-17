/**
 * Created by Wizlight on 22.04.2015.
 */
var td = $('.timeGrid td:not(.disabledTime)'),
    selection = {
        single: function (el) {
            td.not(el).removeClass(this.cl);
            return this.ctrl(el);
        },
        shift: function (el) {
            var till = $(el).index(this.slcr),
                from = this.last >= 0 ? this.last : till + 1;
            if (from > till) till = [from, from = till][0];
            td.not(td.eq(this.last)).removeClass(this.cl);
            td.slice(from, till).add(el).addClass(this.cl);
        },
        ctrl: function (el) {
            //$(el).addClass(this.cl);
            $(el).toggleClass(this.cl);
            this.last = $(el).index(this.slcr);
        },
        slcr: ".timeGrid td:not(.disabledTime)",
        cl: 'pressedTime',
        last: false
    };
td.on('click', function (e) {
    method = !e.shiftKey && !e.ctrlKey ? 'single' : (e.shiftKey ? 'shift' : 'ctrl');
    selection[method](this);
});