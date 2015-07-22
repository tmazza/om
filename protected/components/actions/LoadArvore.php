<?php

/**
 * Description of LoadArvore
 *
 * @author tiago
 */
class LoadArvore extends CAction {

    public function run($raiz = null) {
        if (is_null($raiz)) {
            $nodo = array(
                'id' => 'nodo-o-monitor',
                'name' => 'O Monitor',
                'data' => array(),
            );
            $filhos = array();
            $nodosRaiz = TaxItem::model()->findAll("tipo = " . TaxItem::TipoRaizAutor);
            foreach ($nodosRaiz as $nr) {
                $filhos[] = $this->montaArv3($nr);
            }
            $nodo['children'] = $filhos;
        } else {
            $nodo = $this->montaArv3(TaxItem::model()->findByPk($raiz));
        }
        echo json_encode($nodo);
    }

    private function montaArv3($item) {
        $filhos = array();
        foreach ($item->filhos as $filho) {
            $filhos[] = $this->montaArv3($filho);
        }
        $children = (count($filhos) > 0 ? $filhos : $this->montaArv3Folhas($item));
        $nodo = array(
            'name' => addslashes($item->nome),
            'children' => $children,
            'isChildren' => count($children) == 0,
            'isTopico' => false,
        );
        if ($item->tipo == TaxItem::TipoRaizAutor) {
            $nodo['name'] = $item->autor->nome;
        }
        return $nodo;
    }

    private function montaArv3Folhas($item) {
        $topicos = $item->topicos;
        $filhos = array();
        foreach ($topicos as $top) {
            $filhos[] = array(
                'name' => $top->nome,
                'children' => array(),
                'isChildren' => true,
                'isTopico' => true,
                'url' => Yii::app()->controller->createUrl('topico/ver', array('id' => $top->id)),
            );
        }
        return $filhos;
    }

}
