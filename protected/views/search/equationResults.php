<!--TESTE share-->
<?php
$this->widget('shared.widgets.Arquimedes.Arquimedes', array(
    'tecladoTemplate' => 'template3',
));
?>

<?php
if (!isset($_GET['q']) || (isset($_GET['q']) && strlen($_GET['q']) == 0)) {
    $this->renderPartial('emptySearch');
}
?>
<style>
    <!--
    *, *::before, *::after{
        box-sizing: border-box!important;
    }
    .sage-code input {
        width: auto!important;
    }
    -->
</style>
