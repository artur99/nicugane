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
$(document).on('submit', "#form_addcatdpost", function(e){
    e.preventDefault();
    var fid = "#form_addcatdpost";

    if(markerloading(fid)) return;
    markloading_btn(fid+' [type=submit]');
    var data = new FormData();
    data.append('title', $("#input_title").val().trim());
    data.append('content', $("#input_editor").trumbowyg('html'));
    $.each($('#input_files')[0].files, function(i, file) {
        data.append('file-'+i, file);
    });
    ajax('catedre/add', data, function(data){
        data = form_validate_response_data(data);
        if(data.type == 'error'){
            setTimeout(function(data){
                unmarkloading(fid);
            },100);
        }else{
            form_redirect(data.link, 500, true);
        }
        form_response_fill(fid, data, 'input_files');
    });
});
