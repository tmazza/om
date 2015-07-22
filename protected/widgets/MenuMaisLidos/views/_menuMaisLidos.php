<?php if (count($this->items) > 0 || $this->showEmpty): ?>
    <section class="widget">
        <p class="title" style="font-size: 20px"><?= $this->title; ?></p>
        <div class="tagcloud">
            <?php foreach ($this->items as $item): ?>
                <a href="<?= $item['url']; ?>" class="btn btn-mini"><?= $item['label']; ?></a>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>