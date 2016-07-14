<div class="dropdown">
    <a id="dLabel" role="button" data-toggle="dropdown" class="btn  btn-sm btn-primary" data-target="#" href="/page.html">
        LaTex <span class="caret"></span>
    </a>
    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
        <?php foreach ($categorias as $c): ?>
            <li class="dropdown-submenu">
                <a href="#" onclick="return false;"><?= $c->nome ?></a>
                <ul class="dropdown-menu">
                    <?php foreach ($c->teclas as $t): ?>
                        <li>
                            <a href="#" onclick="return false;" class="btn-tec"  data-code="<?= $t->code; ?>">
                                <?= $t->label; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php $this->render($this->script); ?>