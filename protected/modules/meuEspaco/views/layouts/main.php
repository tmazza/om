<?php $this->beginContent('meuEspaco.views.layouts.raw'); ?>
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3><?= $this->pageTitle; ?></h3>
        </div>
        <div class="box-body">
            <?php echo $content; ?>
        </div>
    </div>
</section>
<?php $this->endContent(); ?>