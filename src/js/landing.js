counter_checker = 0;
function check_counter_run(){
    var bst = $('body').scrollTop()+$(window).height();
    if(!counter_checker && bst > $(".circle").offset().top)
        run_counter_effects();
    else return;
    counter_checker = 1;
}
function run_counter_effects(){
    $.each($(".js-count"), function(i, el){
        $(el).html('');
        var dif = $(el).data('count')/30;
        var max = $(el).data('count');
        var pattern = $(el).data('pattern');
        var sum = 0;
        var countinter = setInterval(function(){
            $(el).html(pattern.replace('*', Math.floor(sum)));
            sum+=dif;
            if(sum>=max){
                clearInterval(countinter);
                $(el).html(pattern.replace('*', max));
                $(el).addClass('zoomed');
                setTimeout(function(){
                    $(el).removeClass('zoomed');
                }, 300);
            }
        }, 26);
    });
}
$(document).ready(function(){
    if(requesturi != '/') return;
    $(window).scroll(check_counter_run);
    check_counter_run();
})
