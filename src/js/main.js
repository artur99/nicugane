$(document).on('click', '.mobilemenu_header i', function(e){
    e.preventDefault();
    if($(".mobilemenu_items").is(":visible")){
        $(".mobilemenu_items").slideUp();
    }else{
        $(".mobilemenu_items").slideDown();
    }
})
