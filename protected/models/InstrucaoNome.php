<?php

/**
 * This is the model class for table "instrucao_nome".
 *
 * The followings are the available columns in table 'instrucao_nome':
 * @property string $id
 * @property string $entradas
 * @property integer $instrucao_id
 *
 * The followings are the available model relations:
 * @property Instrucao $instrucao
 */
class InstrucaoNome extends CActiveRecord {

    public function tableName() {
        return 'instrucao_nome';
    }

    public static function getTableName() {
        return 'instrucao_nome';
    }

    public function rules() {
        return array(
            array('id, entradas, instrucao_id', 'required'),
            array('instrucao_id', 'numerical', 'integerOnly' => true),
            array('id', 'length', 'max' => 64),
            array('id, entradas, instrucao_id', 'safe', 'on' => 'search'),
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
            'entradas' => 'Entradas',
            'instrucao_id' => 'Instrucao',
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function montaExemplos(){
        $entradas = explode('|', $this->entradas);
        $exemplos = array();
        foreach ($entradas as $e){
            $exemplos[] = $id . ' ' . $e;
        }
        return $exemplos;
    }
    
}
