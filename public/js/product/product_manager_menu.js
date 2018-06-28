$( document ).ready(function() {
    //display hidden list child
    $('#product_manager').on('click', function(){
        //find element sibling for toggle
        $(this).siblings('a.product_manager.child').each(function(){
            var children = $(this);
            children.toggle();
        });
    });
});
