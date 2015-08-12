<div class="container">
	<br><br>
	<?php $count = 1; ?>
	<?php foreach ($cats as $c): ?>
	<div class="row">
		<div class="span12 card-container">
		<br>
		<p style="color: #555;font-size:14px;" class='card-container-title'><?=$c->nome;?></p>
		<div class="">
		<br>
		<?php foreach ($c->exemplos as $e): ?>
			<a class="card-micro" href="<?= $this->createUrl('search/ResultEq', array('q' => $e->valor)); ?>">
					<div class='l' style="display:inline-block;">$<?= $e->latex; ?>$</div>
					<?php if($e->layout == ExemplosSearch::LayHor): ?>
						<div style="text-align:right"><?= $e->valor; ?></div>
					<?php else:; ?>
						<div style="float: right;"><?= $e->valor; ?></div>
					<?php endif; ?>
			</a>
		<?php endforeach; ?>
		</div>
		<br><br>
		</div>
		</div>
	<?php $count++; ?>
    <?php endforeach; ?>
</div>
