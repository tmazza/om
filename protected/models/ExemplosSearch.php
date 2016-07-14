<?php

/**
 * This is the model class for table "exemplos_search".
 *
 * The followings are the available columns in table 'exemplos_search':
 * @property integer $id
 * @property string $valor
 * @property string $latex
 * @property integer $categoria_id
 *
 * The followings are the available model relations:
 * @property ExemplosSearchCategoria $categoria
 */
class ExemplosSearch extends CActiveRecord
{
	const LayVer = 1;
	const LayHor = 2;

	public function tableName()
	{
		return 'exemplos_search';
	}

        public static function getTableName()
	{
		return 'exemplos_search';
	}


	public function rules()
	{
		return array(
			array('valor, latex', 'required'),
			array('categoria_id', 'numerical', 'integerOnly'=>true),
			array('latex', 'length', 'max'=>128),
			array('layout,publicado,ordem', 'safe'),
			array('id, valor, latex, categoria_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'categoria' => array(self::BELONGS_TO, 'ExemplosSearchCategoria', 'categoria_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'valor' => 'Valor',
			'latex' => 'Latex',
			'categoria_id' => 'Categoria',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('latex',$this->latex,true);
		$criteria->compare('categoria_id',$this->categoria_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function layoutTipos(){
		return array(
			self::LayVer => 'Vertical',
			self::LayHor => 'Horizontal',
		);
	}

}
