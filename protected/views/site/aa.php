<?php

$w = Widget::model()->findByPk(9);
$this->widget('shared.widgets.Widget.WidgetView', array(
    'str' => $w->code,
    'showParametros' => true,
));
