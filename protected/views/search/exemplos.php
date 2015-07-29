<?php
$exemplos = ExemplosSearch::model()->findAll();
foreach ($exemplos as $e) {
    echo ShView::makeLinkResol($e->valor) . '<br>';
}