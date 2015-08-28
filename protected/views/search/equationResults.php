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

<?php

$instrucao = isset($_GET['q'])?$_GET['q']:'';
$this->widget('shared.widgets.Feedback.Feedback', array(
    'topico' => "Instrução<br> ".$instrucao,
    'autor_nome' => "Luis Gustavo Mendes", 'autor_id' => "19"))
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
