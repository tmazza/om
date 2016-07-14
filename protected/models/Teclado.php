<?php

/**
 * This is the model class for table "teclado".
 *
 * The followings are the available columns in table 'teclado':
 * @property integer $id
 * @property string $nome
 * @property integer $deAplicacao
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property TecladoCategoria[] $tecladoCategorias
 */
class Teclado extends CActiveRecord {

    const Arquimedes = 1;
    const Latex = 2;
    const Sage = 3;
    const Singular = 4;
    const R = 5;
    const Python = 6;

    public function tableName() {
        return 'teclado';
    }

    public static function getTableName() {
        return 'teclado';
    }

    public function rules() {
        return array(
            array('id,nome', 'required'),
            array('user_id,deAplicacao', 'numerical', 'integerOnly' => true),
            array('nome', 'length', 'max' => 128),
            array('id, nome, deAplicacao, user_id', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'categorias' => array(self::HAS_MANY, 'TecladoCategoria', 'teclado_id', 'order' => 'ordem ASC'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nome' => 'Nome',
            'deAplicacao' => 'De Aplicacao',
            'user_id' => 'Autor',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('deAplicacao', $this->deAplicacao);
        $criteria->compare('user_id', $this->user_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function scopes() {
        return array(
            'deAplicacao' => array('condition' => "deAplicacao = 1"),
        );
    }

}
