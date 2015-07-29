<?php if (count($this->items) > 0 || $this->showEmpty): ?>
    <br><br>    
    <section class="widget">
        <p class="title" style="font-size: 20px"><?= $this->title; ?></p>
        <ul class="articles">
            <?php foreach ($this->items as $item): ?>
                <?php $icon = isset($item['emCriacao']) && $item['emCriacao'] ? 'standard' : 'none'; ?>
                <?php $class = isset($item['class']) ? $item['class'] : $icon; ?>
                <li class="article-entry <?= $class; ?> ">
                    <h4><a href="<?= $item['url']; ?>"><?= $item['label']; ?></a></h4>
                    <?php if (isset($item['likes'])): ?>
                        <span class="like-count"><?= $item['likes']; ?></span>
                    <?php endif; ?>
                    <?php if (isset($item['lastUpdate'])): ?>
                        <span class="article-meta">
                            Atualizado em <?= date('d/m/Y', $item['lastUpdate']); ?>
                        </span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>