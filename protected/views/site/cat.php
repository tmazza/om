<?php foreach ($cats as $c): ?>
<?php if(count($c->exemplos)>0||count($c->filhas)>0): ?>
<h4><?=$c->nome;?></h4>
<div>
	<ul class='nav'>
		<li>
			<ul class="nav">
				<?php foreach ($c->exemplos as $e): ?>
					<li>
						<a class="card-micro" href="<?= $this->createUrl('search/ResultEq', array('q' => $e->valor)); ?>">
							<div class='l' style="display:inline-block;">$<?= $e->latex; ?>$</div>
							<?php if($e->layout == ExemplosSearch::LayHor): ?>
								<div style="text-align:right"><?= $e->valor; ?></div>
							<?php else:; ?>
								<div style="float: right;"><?= $e->valor; ?></div>
							<?php endif; ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</li>

		<li>
			<?php $this->renderPartial('cat',array('cats'=>$c->filhas)); ?>
		</li>
	</ul>
</div>
<?php endif; ?>
<?php endforeach; ?>

