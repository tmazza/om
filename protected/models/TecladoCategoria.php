<?php

/**
 * This is the model class for table "teclado_categoria".
 *
 * The followings are the available columns in table 'teclado_categoria':
 * @property integer $id
 * @property string $nome
 * @property string $tamanho
 * @property integer $teclado_id
 *
 * The followings are the available model relations:
 * @property Teclado $teclado
 * @property TecladoTecla[] $tecladoTeclas
 */
class TecladoCategoria extends CActiveRecord {

    public function tableName() {
        return 'teclado_categoria';
    }

    public static function getTableName() {
        return 'teclado_categoria';
    }

    public function rules() {
        return array(
            array('nome, teclado_id', 'required'),
            array('teclado_id', 'numerical', 'integerOnly' => true),
            array('nome', 'length', 'max' => 128),
            array('tamanho', 'length', 'max' => 1),
            array('tamanho', 'in', 'range' => array('p', 'm', 'g', 'x')),
            array('id, nome, tamanho, teclado_id', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'teclado' => array(self::BELONGS_TO, 'Teclado', 'teclado_id'),
            'teclas' => array(self::HAS_MANY, 'TecladoTecla', 'categoria_id', 'order' => 'ordem ASC'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nome' => 'Nome',
            'tamanho' => 'Tamanho',
            'teclado_id' => 'Teclado',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('tamanho', $this->tamanho, true);
        $criteria->compare('teclado_id', $this->teclado_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
