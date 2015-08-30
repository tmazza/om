<?php
/**
 * Created by PhpStorm.
 * User: davi
 * Date: 18/06/15
 * Time: 22:56
 */
class Feedback extends CWidget {

    public $mensagem;
    public $autor_id;

    public function init() {
        $base_url = dirname(__FILE__)."/views/html2canvas";
        $base_url = Yii::app()->getAssetManager()->publish($base_url);
        Yii::app()->clientScript->registerScriptFile($base_url."/html2canvas.js");
        Yii::app()->clientScript->registerCssFile($base_url."/feedback.css");

        Yii::app()->clientScript->registerCssFile($base_url."/loaders.min.css");
        Yii::app()->clientScript->registerScriptFile($base_url."/loaders.css.js",CClientScript::POS_END);

        $script = '
            function capture(){
                var src = "";
                html2canvas(document.body, {
                    //"logging": true, //Enable log (use Web Console for get Errors and Warnings)
                    "useCORS":true,
                    "proxy":"'.$base_url.'/html2canvasproxy.php",
                    "onrendered": function(canvas) {
                        src = canvas.toDataURL("image/png");
                        $("#screenshot_feedback").attr("src",src);
                        $("#screenschot_src").val(src);
                        $("#modalFeedback").dialog("open");

                    }
                });


            }';

        Yii::app()->clientScript->registerScript('FeedbackScreenshot',$script,CClientScript::POS_END);
    }

    public function run() {
        $mensagem = $this->mensagem;
        $this->render('feedback',array("autor_id"=>$this->autor_id,"mensagem"=>$mensagem));
    }

}
