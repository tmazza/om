$(document).ready(function() {
    var originalSize = $('.page-container').css('font-size');
    // reset
    $("img.resetMe").click(function() {
        $('.page-container').css('font-size', originalSize);
    });

    // Increase Font Size
    $("img.increase").click(function() {
        var currentSize = $('.page-container').css('font-size');
        var currentSize = parseFloat(currentSize) * 1.1;
        $('.page-container').css('font-size', currentSize + 'px');

        return false;
    });

    // Decrease Font Size
    $("img.decrease").click(function() {
        var currentFontSize = $('.page-container').css('font-size');
        var currentSize = $('.page-container').css('font-size');
        var currentSize = parseFloat(currentSize) * 0.9;
        $('.page-container').css('font-size', currentSize + 'px');

        return false;
    });
});
