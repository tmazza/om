<?php

/**
 * Description of AutocompleteInstrucao
 *
 * @author tiago
 */
class AutocompleteInstrucao extends CAction {

    public function run($term) {
        $term = ShView::normalizarSting($term);
        $instrucoes = $this->getInstrucoes();

        foreach ($instrucoes as $k => $i){
            $instrucoes[$k]['lcs'] = $this->lcs($i['query'], $term);
            $instrucoes[$k]['levenshtein'] = levenshtein($i['query'], $term);
        }        
        uasort($instrucoes,function($a,$b){
            if($a['lcs'] == $b['lcs'])
                return $a['levenshtein'] > $b['levenshtein'];
            else
                return $a['lcs'] < $b['lcs'];
        });
        $data = array_map(function($i){
            return [
                'label'=>$i['label'],
                'value'=>$i['value']
            ];
        },array_slice($instrucoes,0,10));

        echo json_encode($data);
    }

    private function getInstrucoes(){
        $instrucoes=Yii::app()->cache->get('instrucoes');
        if($instrucoes===false) {
            $instrucoes = array_map(function($i){
                return [
                    'label'=>$i->descricao,
                    'value'=>$i->apelido->id,
                    'query'=>ShView::normalizarSting($i->descricao),
                ];
            },Instrucao::model()->with('apelido')->findAll("publicado=1"));
            Yii::app()->cache->set('instrucoes',$instrucoes,60*2);
        }
        return $instrucoes;
    }


    private function lcs($a,$b){
        $m = strlen($a);
        $n = strlen($b);
        $C = [];
        for($i=0;$i<=$m;$i++) { $C[$i][0] = 0; }
        for($i=0;$i<=$n;$i++) { $C[0][$i] = 0; }     
        for($i=1;$i<=$m;$i++){
          for($j=1;$j<=$n;$j++){
            if($a[$i-1] == $b[$j-1]){
              $C[$i][$j] = $C[$i-1][$j-1] + 1;
            } else {
              $C[$i][$j] = $C[$i-1][$j] > $C[$i][$j-1] ? $C[$i-1][$j] : $C[$i][$j-1];          
            }
          }
        }
        return $C[$m][$n];
    }


}
