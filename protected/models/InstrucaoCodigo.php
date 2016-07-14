<?php

/**
 * This is the model class for table "instrucao_codigo".
 *
 * The followings are the available columns in table 'instrucao_codigo':
 * @property integer $id
 * @property string $descricao
 * @property integer $template
 * @property integer $ordem
 */
class InstrucaoCodigo extends CActiveRecord {

    const TipoAberto = 0;
    const TipoBotao = 1;

    public function tableName() {
        return 'instrucao_codigo';
    }

    public static function getTableName() {
        return 'instrucao_codigo';
    }

    public function rules() {
        return array(
            array('template', 'required'),
            array('ordem', 'numerical', 'integerOnly' => true),
            array('descricao', 'length', 'max' => 128),
            array('tipo', 'in', 'range' => array(self::TipoAberto, self::TipoBotao)),
            array('id, descricao, template, ordem', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'instrucao' => array(self::BELONGS_TO, 'Instrucao', 'instrucao_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'descricao' => 'Descricao',
            'template' => 'Template',
            'ordem' => 'Ordem',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('template', $this->template);
        $criteria->compare('ordem', $this->ordem);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
