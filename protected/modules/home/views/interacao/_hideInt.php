<a href="#!" onclick="loadInteracao('<?=$n->id?>')" >
  <div class="card-panel">
    <div class="row">
      <div class="col m9 s12">
        <?=ucfirst($n->language);?>
      </div>
      <div class="col m3 s12 grey-text text-darken-1 right-align">Editado <?=date('d/m/y H:i',$n->dataEdicao)?></div>
      <!-- <div class="col m2 s6 grey-text text-darken-1 right-align">Criado <?//=date('d/m/y H:i',$n->dataCriacao)?></div> -->
    </div>
  </div>
</a>
