
function getformdata(form){
    var data = _.object(_.map($(form).serializeArray(), _.values));
    return data;
}
//Ajax module

function ajax(node, data, cb, retry){
    if(typeof retry == "number") retry = retry>0 ? retry-1 : 0;
    else retry = 1;

    data.csrftoken = csrftoken;
    if(typeof groups_group_id == 'number') data.gid = groups_group_id;
    $.post('/ajax/'+node, data).done(function(scc_data){
        cb(scc_data, 'success');
    }).fail(function(err_data){

        if(retry){
            setTimeout(function(){
                ajax(node, data, cb, retry);
            }, 250);
        } else cb(err_data, 'error');
    });
}

//Others module

function markloading(btn){
    var btn = $(btn).find('[type=submit]');
    $(btn).addClass('disabled');
}
function unmarkloading(btn){
    var btn = $(btn).find('[type=submit]');
    $(btn).removeClass('disabled');
}
function markloading_btn(btn){
    $(btn).addClass('disabled');
}
function unmarkloading_btn(btn){
    $(btn).removeClass('disabled');
}
var form_loaders = [];
function markerloading(fid){
    if(typeof form_loaders[fid] != 'undefined' && form_loaders[fid]) return 1;
    else return 0;
}
function is_mobile(){
    return $( window ).width() < 600 ? true : false;
}
function pad(width, string, padding) {
  return (width <= string.length) ? string : pad(width, padding + string, padding)
}
function form_validate_response_data(data){
    var resp = {
        'type': 'error',
        'text': 'A apărut o eroare.'
    };
    if(typeof data != 'undefined'){
        if(typeof data.type != 'undefined' && data.type == 'success') resp.type = data.type;
        if(typeof data.text != 'undefined') resp.text = data.text;
        else if(data.type == 'success') resp.text = 'Comanda a fost rulată cu succes.';
    }

    return resp;
}
function form_response_fill(fid, data, lastel){
    $(fid+" input+label").attr('data-error', '');

    if(data.type=='success') $(fid+" input").removeClass('invalid').addClass('valid');
    else $(fid+" input").removeClass('valid').addClass('invalid');

    if(typeof data.text == 'string') $(fid+" input[name="+lastel+"]+label").attr('data-'+data.type, data.text);
    else $.each(data.text, function(i,val){
        if(val){
            $(fid+" input[name="+i+"]+label").attr('data-error', val);
        }
    });
}
function form_redirect(where, time, prel){
    if(typeof prel != 'undefined' && prel) preloader.on();
    setTimeout(function(){
        window.location.href = where;
    },time);

}
