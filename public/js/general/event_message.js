$(document).ready(function() {
    $('.message label.alert').on('click', function (){
        var for_attr = $(this).attr('for');

        var el = document.getElementById('label_'+for_attr);
        if (el) {
            el.scrollIntoView(true);
        } else {
            el = document.getElementById(for_attr);
            if (el) {
                el.scrollIntoView(true);
            }
        }
    });
});

function eventClickAlertMsg()
{
    //find close btn
    var btn_close = $(this).children('a.close');

    //go to that element
    var selector_go_to = $(this).attr('data-selector');

    //click
    if (btn_close.length > 0) {
        btn_close.click();
    }
}