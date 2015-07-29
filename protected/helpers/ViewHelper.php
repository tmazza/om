<?php

/**
 * Description of ViewHelper
 *
 * @author tiago
 */
class ViewHelper {

    public static function renderFlashes() {
        $flashes = Yii::app()->user->getFlashes();
        foreach ($flashes as $id => $value) {
            echo "<div class='click-close alert {$id}'>{$value}</div>";
        }
    }

    public static function makeID($str) {
        return strtolower(str_replace(' ', '_', (ShCode::removeAcentos($str))));
    }

    public static function getSocialLoginButtons(){
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl.'/webroot/monitor/css/zocial/zocial.css');


        $buttons = '
                <p>
			    '.CHtml::linK('Entre com Facebook',array('site/login','provider'=>'facebook'),array('class'=>'zocial facebook')).'
				</p>

				<p>
				'.CHtml::linK('Entre com Google',array('site/login','provider'=>'google'),array('class'=>'zocial google')).'
				</p>

            ';

        return $buttons;

    }

}
