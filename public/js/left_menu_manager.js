$( document ).ready(function() {
    //display hidden list child
    $('#product_manager').on('click', function(){
        //find element sibling for toggle
        $(this).siblings('a.product_manager.child').each(function(){
            var children = $(this);
            children.toggle();
        });
    });

    //display hidden list child
    $('#customer_manager').on('click', function(){
        //find element sibling for toggle
        $(this).siblings('a.customer_manager.child').each(function(){
            var children = $(this);
            children.toggle();
        });
    });

    //display hidden list child
    $('#member_manager').on('click', function(){
        //find element sibling for toggle
        $(this).siblings('a.member_manager.child').each(function(){
            var children = $(this);
            children.toggle();
        });
    });
});
