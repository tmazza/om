<?php

/**
 * This is the model class for table "exemplos_search_categoria".
 *
 * The followings are the available columns in table 'exemplos_search_categoria':
 * @property integer $id
 * @property string $nome
 *
 * The followings are the available model relations:
 * @property ExemplosSearch[] $exemplosSearches
 */
class ExemplosSearchCategoria extends CActiveRecord
{
	public function tableName()
	{
		return 'exemplos_search_categoria';
	}

        public static function getTableName()
	{
		return 'exemplos_search_categoria';
	}


	public function rules()
	{
		return array(
			array('nome', 'required'),
			array('pai_id', 'safe'),
			array('id, nome', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'filhas' => array(self::HAS_MANY,'ExemplosSearchCategoria','pai_id', 'order' => 'ordem ASC'),
			'exemplos' => array(self::HAS_MANY, 'ExemplosSearch', 'categoria_id', 'order' => 'ordem ASC','condition'=>'publicado = 1'),
			'todosExemplos' => array(self::HAS_MANY, 'ExemplosSearch', 'categoria_id', 'order' => 'ordem ASC'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nome' => 'nome',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nome',$this->nome,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
