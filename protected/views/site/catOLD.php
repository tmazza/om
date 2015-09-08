<div class="container" style='padding-left:40px;'>
	<br><br>

	<?php foreach ($cats as $c): ?>
		<?php if(count($c->exemplos)>0||count($c->filhas)>0): ?>
			<ul class='nav'>
				<div onclick='$(this).next().slideToggle();' class='card-container-title '><?=$c->nome;?></div>
				<li class='<?=count($c->filhas)>0 ? '' : 'hide-mob'; ?>'>
					<ul class='nav'>
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
		<?php endif; ?>
	<?php endforeach; ?>
</div>