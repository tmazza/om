
/* ---------------------------------------------------- */
/*	Tabs
 /* ---------------------------------------------------- */
$(function() {

    var $tabsNav = $('.tabs-nav'),
            $tabsNavLis = $tabsNav.children('li');

    $tabsNav.each(function() {
        var $this = $(this);
        $this.next().children('.tab-content').stop(true, true).hide()
                .first().show();
        $this.children('li').first().addClass('active').stop(true, true).show();
    });

    $tabsNavLis.on('click', function(e) {
        var $this = $(this);
        $this.siblings().removeClass('active').end()
                .addClass('active');
        var idx = $this.parent().children().index($this);
        $this.parent().next().children('.tab-content').stop(true, true).hide().eq(idx).fadeIn();
        e.preventDefault();
    });

});
/* ---------------------------------------------------- */
/*	Accordion
 /* ---------------------------------------------------- */
$(function() {
    $('.accordion dt').click(function() {
        $(this).siblings('dt').removeClass('current');
        $(this).addClass('current').next('dd').slideDown(500).siblings('dd').slideUp(500);
    });
});

$(function() {
    $( "#accordion" ).accordion({
        heightStyle: "content",
        active: false,
        collapsible: true
    });
});