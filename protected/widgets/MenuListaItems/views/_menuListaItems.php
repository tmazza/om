<?php if (count($this->items) > 0 || $this->showEmpty): ?>
    <section class="widget">
        <p class="title" style="font-size: 20px"><?= $this->title; ?></p>
        <ul>
            <?php foreach ($this->items as $item): ?>
                <li><a href="<?= $item['url']; ?>" title="<?= $item['label']; ?>"><?= $item['label']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>