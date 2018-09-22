$( document ).ready(function() {
    //display hidden list child
    $('#order_manager').on('click', function(){
        //find element sibling for toggle
        $(this).siblings('a.order_manager.child').each(function(){
            var children = $(this);
            children.toggle();
        });
    });
});
