function eventClickAlertMsg()
{
    $(".alert").off("click");
    $(".alert").unbind("click");
    $(".alert").prop('onclick', null).off('click');

    $('.alert').bind('click', function() {
        console.log('123123123');
        var close_btn = $(this).children('a.close');
        close_btn.click();
    }(10));
}