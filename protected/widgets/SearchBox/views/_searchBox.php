<section class="widget">
    <h3 class="title"><?= $this->title; ?></h3>
    <form method="GET" action="<?= $this->formAction ?>">
        <?php
        echo CHtml::textField($this->inputName, $this->term, array(
            'id' => 'menu-search-box',
            'style' => 'width: 100%;',
            'placeholder' => 'Busca textual em português',
            'autocomplete' => "off",
        ));
        ?>
    </form>
    <div id="menu-search-box-results"></div>
</section>
<?php if ($this->enableAjax): ?>
    <script>
        var delay = (function() {
            var timer = 0;
            return function(callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();

        // A cada digit reseta time out
        $('#menu-search-box').keydown(function() {
            delay(function() {
                makeRequest();
            }, 200);
        });

        function makeRequest() {
            var val = $('#menu-search-box').val();
            if (val.length > 2) {
                $.ajax({
                    method: "GET",
                    url: "<?= $this->source ?>",
                    data: {<?= $this->inputName ?>: val},
                    cache: false,
                    beforeSend: function() {
                        $('#menu-search-box-results').html('<img src="<?= Yii::app()->baseUrl; ?>/webroot/monitor/images/loading.gif" />');
                    },
                }).done(function(data) {
                    if (data.length > 0) {
                        $('#menu-search-box-results').hide(0).html(data).slideDown(100);
                    } else {
                        $('#menu-search-box-results').hide(0).html('Nenhum resultado para "' + val + '"').slideDown(100);
                    }
                });
            }
        }
    </script>
<?php endif; ?>