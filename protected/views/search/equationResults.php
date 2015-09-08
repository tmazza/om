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

?>

<?php
$this->widget('shared.widgets.Feedback.Feedback', array(
    'mensagem' => "Deixe seu feedback ... ",
    'autor_id' => Mensagem::ParaGustavoMendes))
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

<?php ShCode::getGoogleAnalytics();?>