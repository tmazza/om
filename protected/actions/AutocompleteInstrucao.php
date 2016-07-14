<?php

/**
 * Description of AutocompleteInstrucao
 *
 * @author tiago
 */
class AutocompleteInstrucao extends CAction {

    public function run($term) {
        $data = [];

        $exemplos = ExemplosSearch::model()->findAll([
            'condition' => "valor like '%{$term}%' OR latex like '%{$term}%'",
            'limit' => 5,
        ]);
        $data = array_map(function($i){
            return [
                'label'=>'$'.$i->latex.'$',
                'value'=>$i->valor,
            ];
        },$exemplos);
        echo json_encode($data);
    }




}
