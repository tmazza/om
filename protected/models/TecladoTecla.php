<?php

/**
 * This is the model class for table "teclado_tecla".
 *
 * The followings are the available columns in table 'teclado_tecla':
 * @property integer $id
 * @property string $label
 * @property integer $code
 * @property integer $categoria_id
 *
 * The followings are the available model relations:
 * @property TecladoCategoria $categoria
 */
class TecladoTecla extends CActiveRecord {

    public function tableName() {
        return 'teclado_tecla';
    }

    public static function getTableName() {
        return 'teclado_tecla';
    }

    public function rules() {
        return array(
            array('label, code, categoria_id', 'required'),
            array('categoria_id', 'numerical', 'integerOnly' => true),
            array('label', 'length', 'max' => 128),
            array('code', 'length', 'max' => 128),
            array('id, label, code, categoria_id', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'categoria' => array(self::BELONGS_TO, 'TecladoCategoria', 'categoria_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'label' => 'Label',
            'code' => 'Code',
            'categoria_id' => 'Categoria',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('label', $this->label, true);
        $criteria->compare('code', $this->code);
        $criteria->compare('categoria_id', $this->categoria_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
