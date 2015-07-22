<div class="container textCenter">
    <br><br><br>
    <?php foreach ($exemplos as $e): ?>
        <a class="card" href="<?= $this->createUrl('search/ResultEq', array('q' => $e->valor)); ?>">
            <span class="card-label">$$<?= $e->latex; ?>$$</span>
            <span class="card-value"><?= $e->valor; ?></span>
        </a>    
    <?php endforeach; ?>
    <br><br><br>
</div>
<style>
    .card {
        border: 1px solid #ddd;
        border-radius: 2px;
        box-shadow: 1px 1px 1px 1px #ded;
        /*background: red;*/
        width: 340px;
        display: inline-block;
        margin: 6px;
        min-height: 40px; 
        padding: 10px;
        color: #777;
        font-weight: bold;
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
        width: 60%;
    }
</style>