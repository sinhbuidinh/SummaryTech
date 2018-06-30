var string_locale_global = ',';
$(function () {
    var form_name = $('#form_name').val();
    var unit_string_identify = 'unit';
    var number_string_identify = 'number';

    $("select").select2();
    $("input[name^='order_form["+unit_string_identify+"]']").on('keyup', function(){
        //replace all string is not number by empty

        var prod_no = identifyProductNumById($(this).attr('id'));
        var obj_number = $('#'+form_name+'_'+number_string_identify+'_'+prod_no);
        var obj_unit = $(this);

        var new_sum = calculateTotal(obj_number, obj_unit);
        //replace data
        $('#display_total_'+prod_no).html(new_sum);

        //change disp of number by locale
        changeLocaleObject(obj_unit, string_locale_global);
    });
    
    $("input[name^='order_form["+number_string_identify+"]']").on('keyup', function(){
        //replace all string is not number by empty

        var prod_no = identifyProductNumById($(this).attr('id'));
        var obj_number = $(this);
        var obj_unit = $('#'+form_name+'_'+unit_string_identify+'_'+prod_no);

        var new_sum = calculateTotal(obj_number, obj_unit);
        //replace data
        $('#display_total_'+prod_no).html(new_sum);
    });
});

function calculateTotal(obj_number, obj_unit)
{
    var number = obj_number.val();
    var unit = obj_unit.val();

    //replace all str_seperator global first
    number = getValNotLocaleBy(string_locale_global, number);
    unit = getValNotLocaleBy(string_locale_global, unit);

    var new_sum = calculateMulti(number, unit);
    return new_sum;
}

function identifyProductNumById(id_obj)
{
    var arr = id_obj.split('_');
    var arr_length = arr.length;

    var product_no = arr[arr_length - 1];
    return product_no;
}

function calculateMulti(a, b)
{
    if (!a || !b) {
        return 0;
    }

    var multi_rs = parseFloat(a)*parseFloat(b);

    return localeString(multi_rs, string_locale_global);
}

function changeLocaleObject(object, string_seperator)
{
    string_seperator || string_locale_global;

    //identify val of object
    var value = object.val();
    var value_not_locale = value;

    //replace all old seperator if have
    if (value.indexOf(string_seperator) !== -1) {
        //replace all string seperator = ''
        value_not_locale = getValNotLocaleBy(string_seperator, value);
        value = value_not_locale;
    }

    //locale new value with string seperator
    var val_after_locale = localeString(value, string_seperator);

    //change val with new info after locale
    object.val(val_after_locale);

    return value_not_locale;
}

function getValNotLocaleBy(string_seperator, value)
{
    var re = new RegExp(string_seperator, 'g');
    var value_not_locale = value.replace(re, '');

    return value_not_locale;
}

function localeString(x, sep, grp) {
    var sx = (''+x).split('.'), s = '', i, j;
    sep || (sep = ' '); // default seperator
    grp || grp === 0 || (grp = 3); // default grouping

    i = sx[0].length;
    while (i > grp) {
        j = i - grp;
        s = sep + sx[0].slice(j, i) + s;
        i = j;
    }
    s = sx[0].slice(0, i) + s;
    sx[0] = s;
    return sx.join('.');
}
