$(document).on('submit', "#form_login", function(e){
    e.preventDefault();
    var fid = "#form_login";

    if(markerloading(fid)) return;

    markloading(fid);
    ajax('account/login', getformdata(fid), function(data){
        data = form_validate_response_data(data);
        if(data.type == 'error'){
            setTimeout(function(data){
                unmarkloading(fid);
            },100);
        }else{
            form_redirect('/cont', 500, true);
        }
        form_response_fill(fid, data, 'password');
    });
});
$(document).on('submit', "#form_signup", function(e){
    e.preventDefault();
    var fid = "#form_signup";

    if(markerloading(fid)) return;

    markloading(fid);
    ajax('account/signup', getformdata(fid), function(data){
        data = form_validate_response_data(data);
        if(data.type == 'error'){
            setTimeout(function(data){
                unmarkloading(fid);
            },100);
        }else{
            form_redirect('/cont', 500, true);
        }
        form_response_fill(fid, data, 'cpassword');
    });
});
$(document).on('click', '#btn-logout', function(){
    markloading_btn('#btn-logout');
    preloader.on();
    ajax('account/logout', {}, function(){
        setTimeout(function(){
            window.location.href = '/cont';
        }, 400);
    })
});
