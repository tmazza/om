<?php

/**
 * This is the model class for table "search_terms".
 *
 * The followings are the available columns in table 'search_terms':
 * @property integer $id
 * @property string $in
 * @property string $out
 * @property integer $instrucao
 * @property integer $correto
 * @property string $hash
 */
class SearchTerms extends CActiveRecord
{
	public function tableName(){
		return 'search_terms';
	}

    public static function getTableName(){
    	return 'search_terms';
	}

        
	public function rules(){
		return array(
			array('in, out, instrucao', 'required'),
			array('instrucao, correto', 'numerical', 'integerOnly'=>true),
			array('hash', 'length', 'max'=>512),
			array('user_id,ip','safe'),
			array('id, in, out, instrucao, correto, hash', 'safe', 'on'=>'search'),
		);
	}

	public function attributeLabels(){
		return array(
			'id' => 'ID',
			'in' => 'In',
			'out' => 'Out',
			'instrucao' => 'Instrucao',
			'correto' => 'Correto',
			'hash' => 'Hash',
		);
	}

	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public static function add($in,$out,$instrucao=false,$correto=null){
		$model = new SearchTerms();
		$model->in = $in;
		$model->out = $out;
		$model->instrucao = (int)$instrucao;
		$model->correto = $correto;
		$model->hash = hash('sha512',$model->in);
		$model->user_id = Yii::app()->user->isGuest ? null : Yii::app()->user->id;
		$model->ip = $_SERVER['REMOTE_ADDR'];
		return $model->save();
	}
	
}
