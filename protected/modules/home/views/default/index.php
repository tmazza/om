<br>
<div class="card-panel">
  <p class="flow-text">
    Bem vindo(a), <?=Yii::app()->user->nome;?>.
  </p>
  <?php foreach ($notes as $n): ?>
    <!-- <div class="row">
      <div class="col m8 s12">
        <?php echo $n->language .  $n->id;  ?> <br>
      </div>
      <div class="col m2 s6 grey-text">
        asd
      </div>
      <div class="col m2 s6 grey-text">
        Editad0 <?=date('d/m/y H:i:s',$n->dataEdicao  )?>
      </div>
    </div> -->
  <?php endforeach; ?>
</div>
