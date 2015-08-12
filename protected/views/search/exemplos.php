<div class="textCenter">
	<br>
	<div style="margin-right:12px" class="pull-right btn btn-danger btn-mini" onclick="$(this).parent().parent().slideUp().html('');">x</div>
	<h4><?=$nome;?></h4>
	<?php foreach ($exemplos as $e): ?>
		<a class="card" href="<?= $this->createUrl('search/ResultEq', array('q' => $e->valor)); ?>" style="max-width: 360px;" >
			<?php if($e->layout == ExemplosSearch::LayHor): ?>
				<span class="card-label-h">$$<?= $e->latex; ?>$$</span>
				<span class="card-value-h"><?= $e->valor; ?></span>
			<?php else: ?>
				<span class="card-label">$$<?= $e->latex; ?>$$</span>
				<span class="card-value"><?= $e->valor; ?></span>
			<?php endif; ?>
		</a>
	<?php endforeach; ?>
	<br>
</div>
