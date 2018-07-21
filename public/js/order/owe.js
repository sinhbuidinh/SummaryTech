$(document).ready(function() {
    //handle btn export
    $('#export_owe_search').on('click', function(){
        var form = $('form#search');
        $('form#search input[type="hidden"][name="search_by[is_export]"]').val(1);

        form.submit();
    });
    
    //handle when choosing customer or order_code
    $('select#company, select#order_code').on('change', function(){
        var val_search = $(this).val();
        var id = $(this).attr('id');

        var form = $('form#search');
        if (id === 'order_code') {
            //remove all old val
            $('form#search input[type="hidden"][name="search_by[order_code]"]').remove();
            //val is order_id
            $('<input>').attr({
                type: 'hidden',
                id: 'search_by_order_code',
                name: 'search_by[order_code]',
                value: val_search
            }).appendTo(form);
            //search by order_id
        } else {
            $('form#search input[type="hidden"][name="search_by[name]"]').remove();
            //search by customer.short_name or customer.company_name
            $('<input>').attr({
                type: 'hidden',
                id: 'search_by_name',
                name: 'search_by[name]',
                value: val_search
            }).appendTo(form);
        }

        form.submit();
    });

    $('input#date').on('change', function() {
        var form = $('form#search');
        $('form#search input[type="hidden"][name="search_by[date]"]').remove();

        var date = $(this).val();
        $('<input>').attr({
            type: 'hidden',
            id: 'search_by_date',
            name: 'search_by[date]',
            value: date
        }).appendTo(form);

        form.submit();
    });
});