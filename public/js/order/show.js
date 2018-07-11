$( document ).ready(function() {
    $('label.dropdown').on('click', function(){
        var for_att = $(this).attr('for');
        var tbl = $(this).siblings('table[id="'+for_att+'"]');

        if (tbl) {
            toggleCaretWithParent($(this));
            tbl.toggle();
        }
    });
});

function toggleCaretWithParent(parent)
{
    var caret = parent.find('span.caret');
    if (caret) {
        if (caret.hasClass('up')) {
            caret.removeClass('up');
        } else {
            caret.addClass('up');
        }
    }
}
