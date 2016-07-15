<ul id='tec-btn-box-<?= $this->inputID ?>' class="collapsible" style='display:none;'>
  <?php foreach ($categorias as $c): ?>
      <li>
        <div class="collapsible-header truncate" onclick="$('.collapsible-body').slideUp();$(this).next().slideDown();">
          <i class="material-icons">add</i>
          <?= $c->nome ?>
        </div>
        <div class="collapsible-body">
          <?php foreach ($c->teclas as $t): ?>
              <a href="#!" class="btn btn-tec blue-grey" style='margin:2px 4px;' data-code="<?= $t->code; ?>">
                  <?= $t->label; ?>
              </a>
          <?php endforeach; ?>
        </div>
      </li>
  <?php endforeach; ?>
</ul>

<?php $this->render($this->script); ?>
