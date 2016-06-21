//Init functions
$(document).ready(function(){
    preloader = new $.materialPreloader({
        position: 'top',
        col_1: '#f44336!important',
        col_2: '#ffeb3b!important',
        col_3: '#03a9f4!important',
        col_4: '#4caf50!important',
        fadeIn: 30
    });
    $('.dropdown-button').dropdown({
      constrain_width: false,
      hover: false,
      belowOrigin: true,
      alignment: 'right'
    });
    $('ul.tabs').tabs();
    $('select').material_select();
    $(".tooltiped").tooltip();
    $('.modal-trigger').leanModal();
    baguetteBox.run('.bbgallery');
});
