<?php

foreach ($autores as $autor) {
    echo CHtml::link($autor->nome, $this->createUrl('site/autor', array(
                'autor' => $autor->username,
    ))) . '<br>';
}