<?php

/**
 * This is the model class for table "instrucao".
 *
 * The followings are the available columns in table 'instrucao':
 * @property integer $id
 * @property string $descricao
 * @property string $nomes
 */
class Instrucao extends CActiveRecord {
	

    public function tableName() {
        return 'instrucao';
    }

    public static function getTableName() {
        return 'instrucao';
    }

    public function rules() {
        return array(
            array('descricao', 'required'),
            array('descricao', 'length', 'max' => 128),
            array('keywords, labels', 'length', 'max' => 512),
            array('publicado', 'in', 'range' => array(0, 1)),
            array('id, descricao, keywords', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'nomes' => array(self::HAS_MANY, 'InstrucaoNome', 'instrucao_id'),
            'templates' => array(self::HAS_MANY, 'InstrucaoCodigo', 'instrucao_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'descricao' => 'Descricao',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('descricao', $this->descricao, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getParametros() {
        $comandos = $this->templates;
        $code = '';
        foreach ($comandos as $c) {
            $code .= $c->template;
        }
        return ShView::extraiParametros($code);
    }

    public function getLabel($paramName) {
        $s = trim($paramName);
        $id = substr($s, 1, strlen($s) - 1);
        $params = explode(',', $this->labels);
        return isset($params[$id]) ? $params[$id] : $paramName;
    }

    public function montar($data, $mostrarParametros, $execOut = false) {
        $baseViewPath = 'application.widgets.Arquimedes.views.';
        $params = $this->getParametros();

        foreach ($params as $p => $v) {
            if (!isset($data[$p])) {
                $data[$p] = $v;
            }
        }
        // Parâmetros em uso
        $output = Yii::app()->controller->renderPartial($baseViewPath . '_execSage', true, $execOut);

        if ($mostrarParametros) {
            $paramInput = Yii::app()->controller->renderPartial($baseViewPath . '_params', array(
                'params' => $data,
                'inst' => $this,
                    ), true);
            $output .= $paramInput;
        }
        $org = Organizacao::model()->findByAttributes(array(
            'orgID' => 'monitor',
        ));

        // Template usados na instrução
        $codes = $this->templates;
        foreach ($codes as $c) {
            $output .= Yii::app()->controller->renderPartial($baseViewPath . '_template', array(
                'conteudo' => stripslashes(unserialize($org->traducoes)) . "\r\n" . ShView::mergeDataToTemplate($c->template, $data),
                'comando' => $c,
                'n' => $c->id == 6 || $c->id == 7,
                    ), true);
        }
        // Rodapé com busca por palavras chave
//        $topicosRelacionados = $this->getItems(str_replace(',', ' ', $inst->keywords), 10);
        $topicosRelacionados = array();
        $output .= Yii::app()->controller->renderPartial($baseViewPath . '_rodape', array(
            'topicos' => CHtml::listData($topicosRelacionados, 'id', 'nome'),
                ), true);
        return $output;
    }

    public function scopes() {
        return array(
            'publicada' => array(
                'condition' => "publicado = 1",
            ),
        );
    }

}
