function getP() {
    data = {};
    $('#params input').each(function() {
        data[$(this).attr('data-id')] = $(this).val();
    });
    return JSON.stringify(data);
}