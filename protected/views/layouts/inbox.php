<?php $this->beginContent('application.views.layouts.semColunas'); ?>
<div class="row">
    <div class="span2"></div>
    <div class="span8" style="overflow: hidden;">
        <?php echo $content; ?>
    </div>
    <div class="span2"></div>
</div>
<?php $this->endContent(); ?>