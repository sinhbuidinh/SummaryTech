$(document).ready( function(){
    setDropDownVal();

    $('ul#lang_id li').click(function(){
        var li_clicked = $(this);

        //remove old active
        $('ul#lang_id li.active').removeClass('active');
        //add new active
        li_clicked.addClass('active');

        //change input lang_id
        $('input[name="article_type_form[lang_id]"]').val(li_clicked.val());

        //change text display
        var button = li_clicked.parent('ul#lang_id').siblings('button#lang_disp');
        var text_disp = getDispNameOfLangId(li_clicked.val());

        button.html(text_disp.trim());
    });

    eventClickAlertMsg();
});

function setDropDownVal()
{
    var lang_id_val = $('input[type="hidden"][name="article_type_form[lang_id]"]').val();
    var str_li_active = 'ul#lang_id li[value="' + lang_id_val + '"]';

    //add class
    $(str_li_active).addClass('active');
    //change text button dropdown display
    var lang_name = getDispNameOfLangId(lang_id_val);
    $('button#lang_disp').html(lang_name.trim());
}

function getDispNameOfLangId(lang_id)
{
    var lang_name = "Default";

    var element_find = $('ul#lang_id li[value="' + lang_id + '"]');
    if (element_find
        && element_find.length > 0
    ) {
        return element_find.attr('data-lang-name');
    }

    return lang_name;
}
