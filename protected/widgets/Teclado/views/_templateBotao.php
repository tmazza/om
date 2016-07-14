<?php $size = isset($size) ? $size : 'p'; ?>
<?php $btnClass = isset($btnClass) ? $btnClass : 'btn-default'; ?>
<div class="btn-tec-container">
    <button style="font-size:12px;padding:0px;" type="button" class="btn <?= $btnClass; ?> btn-tec btn-<?= $size ?>" data-code="<?= $code; ?>"><?= $label; ?></button>
</div>
