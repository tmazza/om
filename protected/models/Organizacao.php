<?php

/**
 * This is the model class for table "organizacao".
 *
 * The followings are the available columns in table 'organizacao':
 * @property integer $id
 * @property string $nome
 * @property string $orgID
 * @property integer $rec_questoes
 * @property integer $rec_topicos
 *
 * The followings are the available model relations:
 * @property UserAutor[] $userAutors
 */
class Organizacao extends CActiveRecord {

    public function tableName() {
        return 'organizacao';
    }

    public static function getTableName() {
        return 'organizacao';
    }


    public function attributeLabels() {
        return array(
            'apresentacao' => 'Apresentação',
            'referencias' => 'Referências',
            'modoDeUsar' => 'Modo de usar',
            'comentarios' => 'Primeiras impressões',
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }


    /**
     * Retorna os recursos disponíveis para a organização.
     * Colunos iniciadas com 'rec_' em organização são tratadas como booleanos
     * para definir o uso ou não do recurso.
     * @return type
     */
    public function getRecursos() {
        $recursos = array();
        foreach ($this->attributes as $attr => $value) {
            if (substr($attr, 0, 4) == 'rec_' && $value == 1) {
                $recursos[] = substr($attr, 4);
            }
        }
        return $recursos;
    }


}
