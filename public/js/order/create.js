var STR_LOCALE_GLOBAL = ',';
$(function () {
    var form_name = $('#form_name').val();
    var unit_string_identify = 'unit';
    var number_string_identify = 'number';

    $("select").select2();
    $("input[name^='order_form["+unit_string_identify+"]']").on('keyup', function(){
        var prod_no = identifyProductNumById($(this).attr('id'));
        var obj_number = $('#'+form_name+'_'+number_string_identify+'_'+prod_no);
        var obj_unit = $(this);

        var new_sum = calculateTotal(obj_number, obj_unit);
        //replace data display
        $('#display_total_'+prod_no).html(new_sum);

        //change disp of number by locale
        changeLocaleObject(obj_unit, STR_LOCALE_GLOBAL);

        //new_sum not locale
        setTotalPrice(form_name, prod_no, new_sum);

        //re_calculate total
        var new_sum_total = calculateSumTotal();
        setSumTotal(new_sum_total);
    });
    
    $("input[name^='order_form["+number_string_identify+"]']").on('keyup', function(){
        var prod_no = identifyProductNumById($(this).attr('id'));
        var obj_number = $(this);
        var obj_unit = $('#'+form_name+'_'+unit_string_identify+'_'+prod_no);

        var new_sum = calculateTotal(obj_number, obj_unit);
        //replace data
        $('#display_total_'+prod_no).html(new_sum);

        //change total num
        var total_num = calculateSumNum();
        var total_num_with_locale = localeString(total_num, STR_LOCALE_GLOBAL);

        //change data input
        $('#order_form_total_all_number').val(total_num_with_locale);
        //add html disp
        $('#total_all_number_disp').html(total_num_with_locale);

        //change disp of number by locale
        changeLocaleObject(obj_number, STR_LOCALE_GLOBAL);

        //new_sum not locale
        setTotalPrice(form_name, prod_no, new_sum);

        //re_calculate total
        var new_sum_total = calculateSumTotal();
        setSumTotal(new_sum_total);
    });
});

function setTotalPrice(form_name, prod_no, new_sum)
{
//    var new_total_not_locale = removeNotDigitChar(new_sum);
    $('#'+form_name+'_total_'+prod_no).val(new_sum);
}

function setSumTotal(total)
{
    total = removeNotDigitChar(total);
    //add locale
    total = localeString(total, STR_LOCALE_GLOBAL);

    $('#order_form_total_all_total').val(total);
    $('#total_all_total_disp').html(total);
}

function calculateSumTotal()
{
    var sum_total = parseInt(0);

    $('input[name^="order_form[total]"]').each(function(){
        var number_this = $(this).val();
        var num_without_digit = removeNotDigitChar(number_this);

        //sum count up
        var int_num = parseInt(num_without_digit);
        if (isNaN(int_num)) {
            return;
        }

        sum_total = sum_total + int_num;
    });

    return parseInt(sum_total);
}

function calculateSumNum()
{
    var sum_num = parseInt(0);

    $('input[name^="order_form[number]"]').each(function() {
        var number = $(this).val();
        //remove not digit
        number = removeNotDigitChar(number);

        var number_this = parseInt(number);
        //sum count up
        if (!isNaN(number_this)) {
            sum_num += number_this;
        }
    });

    return parseInt(sum_num);
}

function removeNotDigitChar(value_input)
{
    if (parseInt(value_input) === 0) {
        return value_input;
    }
    value_input = value_input.toString();

    var value = getValNotLocaleBy(STR_LOCALE_GLOBAL, value_input);

    var regex = /\D+/g;
    var value_is_num = value.replace(regex, '');

    return value_is_num;
}

function calculateTotal(obj_number, obj_unit)
{
    var number = obj_number.val();
    var unit = obj_unit.val();

    if (parseInt(number) === 0
        || parseInt(unit) === 0
    ) {
        return 0;
    }

    //replace all str_seperator global first
    number = getValNotLocaleBy(STR_LOCALE_GLOBAL, number);
    unit   = getValNotLocaleBy(STR_LOCALE_GLOBAL, unit);

    //replace all string is not number by empty
    number = removeNotDigitChar(number);
    unit   = removeNotDigitChar(unit);

    return calculateMulti(number, unit);
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

    return localeString(multi_rs, STR_LOCALE_GLOBAL);
}

function changeLocaleObject(object, string_seperator)
{
    string_seperator || STR_LOCALE_GLOBAL;

    //identify val of object
    var value = object.val();
    var value_not_locale = value;

    //replace all old seperator if have
    if (value.indexOf(string_seperator) !== -1) {
        //replace all string seperator = ''
        value_not_locale = getValNotLocaleBy(string_seperator, value);
        value = value_not_locale;
    }

    //replace all string is not number by empty
    value = removeNotDigitChar(value);

    //locale new value with string seperator
    var val_after_locale = localeString(value, string_seperator);

    //change val with new info after locale
    object.val(val_after_locale);
    object.attr('value', val_after_locale);

    return value_not_locale;
}

function getValNotLocaleBy(string_seperator, value)
{
    if (typeof value === 'undefined' 
        || typeof value.length === 'undefined' 
        || value.length <= 1
    ) {
        return value;
    }
    value = value.toString();

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
