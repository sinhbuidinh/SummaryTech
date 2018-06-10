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