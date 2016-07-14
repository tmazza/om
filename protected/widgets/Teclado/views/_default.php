<script>
    $('#tec-btn-box-<?= $this->inputID ?> .btn-tec').on('click', function() {
        var elem = $('#' + '<?= $this->inputID; ?>');
        var cursorPosStart = elem.prop('selectionStart');
        var cursorPosEnd = elem.prop('selectionEnd');
        var v = elem.val();
        var textBefore = v.substring(0, cursorPosStart);
        var textAfter = v.substring(cursorPosEnd, v.length);
        txt = textBefore + $(this).attr('data-code') + textAfter;
        openSel = txt.indexOf('{');
        closeSel = txt.indexOf('}');
        if (openSel !== -1 && closeSel !== -1) {
            if (openSel > closeSel) {
                aux = openSel;
                openSel = closeSel;
                closeSel = aux;
            }
            txt = txt.replace('{', '').replace('}', '');
            elem.val(txt);
            document.getElementById('<?= $this->inputID; ?>').setSelectionRange(openSel, closeSel - 1);
        } else {
            elem.val(txt);
        }
        elem.focus();
    });
</script>
