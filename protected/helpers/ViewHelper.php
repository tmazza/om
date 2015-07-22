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

}
