<div class="textCenter">
	<br>
	<div style="margin-right:12px" class="pull-right btn btn-danger btn-mini" onclick="$(this).parent().parent().slideUp().html('');">x</div>
	<h4><?=$nome;?></h4>
	<?php foreach ($exemplos as $e): ?>
		<a class="card" href="<?= $this->createUrl('search/ResultEq', array('q' => $e->valor)); ?>" style="max-width: 260px;" >
			<span class="card-label">$$<?= $e->latex; ?>$$</span>
			<span class="card-value"><?= $e->valor; ?></span>
		</a>    
	<?php endforeach; ?>
	<br>
</div>
