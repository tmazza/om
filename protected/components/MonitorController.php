<?php

/**
 * Description of MonitorController
 *
 * @author tiago
 */
class MonitorController extends Controller {

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $pageCaption = ''; // SEO
    public $pageDescription = ''; //
    // Se o bloco com busca deve ser mostrado ou não. LAYOUTS: todos.
    public $showMainSearch = false;
    // Se a busca deve ser mostrada no menu lateral
    public $titleMenuSearch = 'Buscar tópico';
    public $showMenuSearch = true;
    // Menu com tópicos em destaque. LAYOUTS: colunaDireita.
    public $titleMenuContexto = 'Tópicos em destaque';
    public $menuContexto = array();
    // Menu com tópicos mais lidos. LAYOUTS: colunaDireita.
    public $titleTags = 'Tópicos em destaque';
    public $tags = array();
    // Menu com subindice de tópico. LAYOUTS: colunaDireita.
    public $titleSubindice = 'Subtópicos';
    public $subindice = array();
    // Árvore de conteúdo
    public $showArvoreConteudo = false;
    // Opção para esconder menu
    public $showHideMenu = false;
    // Menu de conteúdo em layout com colyna à direita
    public $showMenuConteudo = true;
    // Define se dados para o facebook devem ser incluidos em layouts/main
    public $faceData = false;


    protected function beforeAction($action) {
        $topicoDestaque = Topico::getDestaquesAleatorios(12);
        foreach ($topicoDestaque as $td) {
            $this->menuContexto[] = ShCode::makeItem($td->nome, $this->createUrl('topico/ver', array('id' => $td->id)), array(
                        'emCriacao' => $td->emCriacao,
            ));
        }
        return parent::beforeAction($action);
    }

    public function multiLevelMenu() {
        $menu = Yii::app()->cache->get('menuMultiNivel');
        if ($menu === false) {
            $user = User::model()->findByAttributes(array(
                'username' => 'mendes.lg',
            ));
            if (!is_null($user)) {
                // Fixo para raiz de conteúdo de mendes.lg Genérico: $raizes = TaxItem::model()->findAll("tipo = " . TaxItem::TipoRaizAutor);
                $raiz = TaxItem::model()->find("tipo = " . TaxItem::TipoRaizAutor . " AND user_id = {$user->id}");
            }
            if (!is_null($raiz)) {
                $raizes = $raiz->filhos;
                $menu = array();
                foreach ($raizes as $raiz) {
                    $menu[] = $this->montaNodoMenu($raiz);
                }
                Yii::app()->cache->set('menuMultiNivel', $menu, 60 * 10);
            } else {
                $menu = array();
            }
        }
        return $menu;
    }

    private function montaNodoMenu($item) {
        $nodo = array();
        $nodo['qtdFilhos'] = 0;
        $nodo['label'] = ($item->nome);
        $nodo['url'] = 'asdasd';
        $items = array();
        // TODO: relação de filhos deve buscar somente items do tipo no
        foreach ($item->filhos as $f) {
            $items[] = $this->montaNodoMenu($f);
        }

        if (count($item->topicos) > 0) {
            $topicos = array();
            foreach ($item->topicos as $t) {
                $topicos[] = array(
                    'label' => $t->nome,
                    'id' => $t->id,
                );
            }
            $nodo['topicos'] = $topicos;
        }

        $nodo['items'] = $items;
        return $nodo;
    }

}
