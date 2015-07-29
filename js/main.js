$('.click-close').click(function() {
    $(this).slideUp(1000, function() {
        $(this).remove();
    });
});
$('.hide-on-hover, .show-on-hover').parent().hover(function() {
    $(this).find('.show-on-hover').css('display', 'block');
    $(this).find('.hide-on-hover').css('display', 'none');
});
$('.show-on-hover').parent().mouseleave(function() {
    $(this).find('.show-on-hover').css('display', 'none');
    $(this).find('.hide-on-hover').css('display', 'block');
});
$('.nodo-edit').hover(function() {
    $(this).parent().css('background', '#eaeaea');
});
$('.nodo-edit').mouseleave(function() {
    $(this).parent().css('background', 'transparent');
});
