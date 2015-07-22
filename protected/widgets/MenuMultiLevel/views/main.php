<section class="widget">
    <h3 class="title"><?= $this->title; ?></h3>
    <div class="tagcloud">
        <?php $this->render('_menu', array('a' => $a)); ?>
    </div>
</section>