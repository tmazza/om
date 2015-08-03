<div class="container textCenter">
	<br><br>
	<?php $count = 1; ?>
	<?php foreach ($cats as $c): ?>
		<?= ($count % 3 == 0) ? '<div class="row">' : null; ?>
		<div class="span4 card-container">
		<p style="color: #555;text-align:center;font-size:20px;" class='card-container-title'><?=$c->nome;?></p>
		<div class="card-box">
		<?php foreach ($c->exemplos as $e): ?>
			<a class="card" href="<?= $this->createUrl('search/ResultEq', array('q' => $e->valor)); ?>">
				<?php if($e->layout == ExemplosSearch::LayHor): ?>
					<span class="card-label-h">$$<?= $e->latex; ?>$$</span>
					<span class="card-value-h"><?= $e->valor; ?></span>				
				<?php else: ?>
					<span class="card-label">$$<?= $e->latex; ?>$$</span>
					<span class="card-value"><?= $e->valor; ?></span>
				<?php endif; ?>
			</a>    
		<?php endforeach; ?>
		</div>
		<br><br>
		<?= ($count % 3 == 0) ? '</div>' : null; ?>
		</div>
	<?php $count++; ?>
    <?php endforeach; ?>
</div>
