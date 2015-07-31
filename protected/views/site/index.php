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
				<span class="card-label">$$<?= $e->latex; ?>$$</span>
				<span class="card-value"><?= $e->valor; ?></span>
			</a>    
		<?php endforeach; ?>
		</div>
		<br><br>
		<?= ($count % 3 == 0) ? '</div>' : null; ?>
		</div>
	<?php $count++; ?>
    <?php endforeach; ?>
</div>
<style>
	.card-box {
		height: 290px;
		overflow: hidden;
		overflow-y: auto;	
-webkit-box-shadow: inset 0px 3px 6px 0px rgba(207,203,207,1);
-moz-box-shadow: inset 0px 3px 6px 0px rgba(207,203,207,1);
box-shadow: inset 0px 3px 6px 0px rgba(207,203,207,1);	}
	.card-container-title {
		border-bottom: 1px solid #ddd;
		margin: 0px;
		height: 40px;		
	}
    .card {
        border: 1px solid #ddd;
        border-radius: 2px;
        box-shadow: 1px 1px 1px 1px #ded;
        /*background: red;*/
        width: 87%;
        display: inline-block;
        margin: 6px;
        min-height: 40px; 
        padding: 10px;
        color: #777;
        text-align: center;
    }
    .card .card-label, .card .card-value {
        display: inline-block;
        box-sizing: border-box;
    }
    .card .card-label {
        border-right: 1px solid #ddd;

    }
    .card .card-label {
        width: 35%;
    }
    .card .card-value {
		font-family:monospace;
        width: 60%;
    }
</style>
