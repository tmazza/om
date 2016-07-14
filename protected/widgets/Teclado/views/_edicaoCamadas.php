<script>
    $('.btn-tec').on('click', function() {
        var elem = $('#' + '<?= $this->inputID; ?>');
        txt = $(this).attr('data-code').replace('{', '').replace('}', '');

        if ($('#latex-mark').is(":checked")) {
            txt = '$' + txt + '$';
            $('#latex-mark').prop('checked', false);
        }

        elem.redactor('insert.html', txt, false);
    });
</script>